<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function show($name, $subcategory){
        $category = Category::whereName($name)->firstOrFail();
        $subcategory = SubCategory::whereSlug($subcategory)->firstOrFail();
        return view('subcategory.show', ['category' => $category, 'subcat' => $subcategory]);
    }
}
