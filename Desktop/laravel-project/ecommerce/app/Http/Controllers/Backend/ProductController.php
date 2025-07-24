<?php

namespace App\Http\Controllers\Backend;
use App\Models\Category;
use App\Models\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class ProductController extends Controller
{
    public function __construct(){
        $this->returnUrl ="/products";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
    $products = Product::with('images')->get();
    return view('backend.products.index', compact('products'));
}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return response(view("backend.products.insert_form", ["categories"=> $categories]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ProductRequest  $request
     * @return \Illuminate\Http\Response
     */
   public function store(ProductRequest $request)
    {
        $product = new Product();
        $data =$this->prepare($request,$product->getFillable());
        $product->fill($data);
        $product->save();

        return redirect()->route("products.index");
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view("backend.products.update_form",["product"=>$product,"categories"=> $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $data = $this->prepare($request, $product->getFillable());
        $product->fill($data);
        $product->save();
        return redirect()->route("products.index");
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route("products.index");
    }
}
