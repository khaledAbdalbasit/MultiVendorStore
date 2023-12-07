<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Catergory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;
class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $request=request();
        $categories = Catergory::with('parent')
        /*leftJoin('categories as parents' , 'parents.id' , '=' , 'categories.parent_id')
        ->select([
            'categories.*',
            'parents.name as parent_name'
        ])*/
        // ->select('categories.*')
        // ->selectRaw('(SELECT COUNT(*) FROM products WHERE category_id = categories.id) as products_count')
        ->withCount([
            'products as products_count' =>function($query){
                $query->where('status' ,'=','active ');
            }
            ])
        ->filter($request->query())
        ->orderBy('categories.name')
        ->paginate();//Return collection object
        return view('dashboard.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $parents=Catergory::all();
        $category=new Catergory();
        return view('dashboard.categories.create',compact('category','parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        //
        // $category=new Catergory();
        // $category->name=$request->name;
        // $category->parent_id = $request->post('parent_id');
        // $category->name = $request->post('');

        // Validate data before add to data base


        $clean_data=$request->validate(Catergory::rules(),[
            'unique'=>'this name already exsists!'
        ]);

        // Add photo
        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);
        $data = $request->except('image');
        $data['image']=$this->uploadImage($request);

        $category = Catergory::create($data);
        return Redirect::route('dashboard.categories.index')
        ->with('success','Category created!');// Massage for user
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Catergory $category)
    {
        return view('dashboard.categories.show',[
            'category'=>$category
        ]);
    }

    /** 
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
        $category=Catergory::findOrFail($id);
        }
        catch(Exception $e)
        {
            return Redirect::route('dashboard.categories.index')
            ->with('info', 'Record not found'); // massage for user
        }
        $parents = Catergory::where('id','<>',$id)
        ->where(function($query) use ($id){
        $query->whereNull('parent_id')
        ->orWhere('parent_id', '<>', $id);
        })
        ->get();
        return view('dashboard.categories.edit',compact('category', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {

        //$request->validate(Catergory::rules($id));
        //
        $category = Catergory::find($id);

        $old_image=$category->image;

        $data = $request->except('image');

        $new_image = $this->uploadImage($request);
        if($new_image)
        {
            $data['image']= $new_image;
        }
        $category->update($data);
        if($old_image && $new_image)
        {
            Storage::disk('public')->delete($old_image);
        }
        return Redirect::route('dashboard.categories.index')
        ->with('success', 'Category updated!');
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
        // $category = Catergory::findOrFail($id);
        // $category->delete();

        // Catergory::where('id','=',$id)->delete();
        $category = Catergory::findOrFail($id);
        $category->delete();
        // if($category->image)
        // {
        //     Storage::disk('public')->delete($category->image);
        // }
        return Redirect::route('dashboard.categories.index')
        ->with('success', 'Category deleted!');
    }

    protected function uploadImage(Request $request)
    {
        if(!$request->hasFile('image'))
        {
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

    public function trash()
    {
        $categories=Catergory::onlyTrashed()->paginate();
        return view('dashboard.categories.trash',compact('categories'));
    }

    public function restore(Request $request,$id)
    {
        $category=Catergory::onlyTrashed()->findOrFail($id);
        $category->restore();

        return redirect()->route('dashboard.categories.trash')
        ->with('succes','Category restored!');
    }

    public function forceDelete($id)
    {
        $category=Catergory::onlyTrashed()->findOrFail($id);
        $category->forceDelete();
        if($category->image)
        {
            Storage::disk('public')->delete($category->image);
        }
        return redirect()->route('dashboard.categories.trash')
        ->with('succes','Category deleted forever!');
    }
}
