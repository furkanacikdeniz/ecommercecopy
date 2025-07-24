<?php

namespace App\Http\Controllers\Backend;
use App\Models\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class CategoryController extends Controller
{
    public function __construct(){
        $this->returnUrl ="/categories/{}/categories";
    }
    public $returnUrl= "/categories";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view("backend.categories.index", ["categories" => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("backend.categories.insert_form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
   public function store(CategoryRequest $request)
    {
        $category = new category();
        $data =$this->prepare($request,$category->getFillable());
        $category->fill($data);
        $category->save();
        return redirect()->route("categories.index");
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {

        return view("backend.categories.update_form",["category"=>$category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $data = $this->prepare($request, $category->getFillable());
        $category->fill($data);
        $category->save();
        return redirect()->route("categories.index");
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route("categories.index");
    }
}
