<?php

namespace App\Http\Controllers\Front\Categories;

use App\Http\Controllers\Controller;
use App\Models\Catergory;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function show(Catergory $category)
    {
        $products = Product::with(['category', 'store'])->get();
        $categories = Catergory::all();
        return view('front.products.categories.DigitalCameras', compact('category', 'products'));
    } //front.products.categories.DigitalCameras

    public function show2(Catergory $category)
    {
        $products = Product::with(['category', 'store'])->get();
        $categories = Catergory::all();
        return view('front.products.categories.accessories', compact('category', 'products'));
    } //front.products.categories.DigitalCameras

    public function show3(Catergory $category)
    {
        $products = Product::with(['category', 'store'])->get();
        $categories = Catergory::all();
        return view('front.products.categories.televisions', compact('category', 'products'));
    }

    public function show4(Catergory $category)
    {
        $products = Product::with(['category', 'store'])->get();
        $categories = Catergory::all();
        return view('front.products.categories.watch', compact('category', 'products'));
    }
}
