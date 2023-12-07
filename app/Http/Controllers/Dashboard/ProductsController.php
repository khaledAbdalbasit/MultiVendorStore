<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        $products=Product::with(['category', 'store'])->paginate();

        return view('dashboard.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { //
        $parents = Product::all();
        $product = new Product();
        return view('dashboard.products.create', compact('product', 'parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);
        $data = $request->except('image','name');
        $data['image'] = $this->uploadImage($request);

        $numberOfCharacters = strlen($request->name);
        if ($numberOfCharacters <= 10 ) {
            $data['name'] = $request->name;
        }
        else{
            return response()->json(['error' => 'Text shold be betwwen 200 : 250'], 400);

        }
        $product = Product::create($data);
        return Product::route('dashboard.products.index')
        ->with('success', 'Category created!');// Massage for user
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product=Product::findOrFail($id);

        $tags=implode(',',$product->tags()->pluck('name')->toArray());

        return view('dashboard.products.edit',compact('product','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        // $product->update($request->except('tags'));
        // // $tags = json_decode(',', $request->post('tags'));
        // // $tag_ids = [];
        // // $saved_tags = Tag::all();
        // // foreach($tags as $item){
        // //     $slug=Str::slug($item->vlaue);
        // //     $tag = $saved_tags->where('slug', $slug)->first();

        // //     if(!$tag)
        // //     {
        // //         $tag=Tag::create([
        // //             'name'=>$item->vlaue,
        // //             'slug'=>$slug,
        // //         ]);
        // //     }

        // //     $tag_ids[]=$tag->id;
        // // }
        // // $product->tags()->sync($tag_ids);
        // return redirect()->route('dashboard.products.index')
        // ->with('success','product updated');

        $product = Product::find($id);

        $old_image = $product->image;

        $data = $request->except('image');

        $new_image = $this->uploadImage($request);
        if ($new_image) {
            $data['image'] = $new_image;
        }
        $product->update($data);
        if ($old_image && $new_image) {
            Storage::disk('public')->delete($old_image);
        }
        $numberOfCharacters = strlen($request->name);
        if ($numberOfCharacters >= 40 && $numberOfCharacters <=100) {
            $data['name'] = $request->name;
        } else {
            return response()->json(['error' => 'Text shold be betwwen 50 : 100'], 400);
        }
        return redirect()->route('dashboard.products.index')
        ->with('success','product updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    protected function uploadImage(Request $request)
    {
        if (!$request->hasFile('image')) {
            return;
        }

        $file = $request->file('image'); // UploadeFile object
        // $file->getClientOriginalName();// The original name for image
        // $file->getSize();// Get size of image per pic
        // $file->getClientOriginalExtension();// Return file exctension
        // $file->getMimeType();//Return type of file

        $path = $file->store('uploads', [
            'disk' => 'public'
        ]);
        return $path;
    }
}
