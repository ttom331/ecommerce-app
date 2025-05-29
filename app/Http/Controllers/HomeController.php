<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $products = Product::with(['category'])->where('featured', true)->latest()->take(8)->get(); //simplePaginate(8); //need to add checks, error if there are no products with or without feautred.
        $category = Category::get();
        return view('welcome', [
            'featuredProducts' => $products,
            'categories' => $category
        ]);
    }
}
