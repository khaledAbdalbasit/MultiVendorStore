<?php

namespace App\Http\Controllers\Front\Categories;

use App\Http\Controllers\Controller;
use App\Models\Catergory;
use App\Models\Product;
use Illuminate\Http\Request;

class AccessoriesController extends Controller
{
    public function show(Product $products, Catergory $category)
    {
        $accessories = Product::with(['category', 'store'])->paginate(4);
        $categories = Catergory::all();
        return view('front.products.categories.accessories', compact('accessories'));
    }
}
