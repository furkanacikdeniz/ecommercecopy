<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index($categorySlug ="")
    {
        if (Str::of($categorySlug)->isNotEmpty()) {
            $selectedCategory = \App\Models\Category::all()->where( key: "is_active", operator: true) ->where("slug",$categorySlug)->first();
            $products = $selectedCategory->products;
        }else {
            $products = \App\Models\Product::all()->where("is_active",true) ;
        }
        $categories = \App\Models\Category::all()->where("is_active",true);

        return view('frontend.home.index', ['categories'=> $categories,'products'=> $products]);
    }
}
