<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductImageRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Product;
use App\Models\ProductImage;
use Storage;

class ProductImageController extends Controller
{
    /**
     * The URL to redirect to after storing an address.
     *
     * @var string
     */
    public $returnUrl = '/products/{}/images';

    public function __invoke(){
    $product_id = request()->route('product'); // URL'deki {product} parametresini al
    $product = Product::findOrFail($product_id); // Product'ı veritabanından bul
    $addrs = $product->addrs; // Adres ilişkisini yükle

    return view('backend.images.index', [
        'product' => $product,
        'addrs' => $addrs
    ]);
}
    public function __construct(){
        $this->returnUrl = "/products/{}/images";
        $this->fileRepo = "public/products";
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Product $product): View
    {

        $product = Product::findOrFail($product->product_id);
        $images = $product->images()->get();
        return view("backend.images.index", ["product" => $product, "images" => $images]);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product): View
    {
    return view("backend.images.insert_form", ["product"=> $product]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Product $product, ProductImageRequest $request):RedirectResponse
    {
        $product = Product::findOrFail($product->product_id);
        $productImage = new ProductImage() ;
        $data =$this->prepare( $request, $productImage ->getFillable() );
        $productImage -> fill($data);
        $productImage->fill($data);
        $productImage->save();

        $this->editReturnUrl($product->product_id);
        return Redirect::to($this->returnUrl);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product, ProductImage $image): View
    {
        return view("backend.images.update_form", ["product" => $product, "image" => $image]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductImageRequest $request, Product $product, ProductImage $image): RedirectResponse
    {
        $data = $this->prepare($request, $image->getFillable());
        $image->fill($data);
        $image->save();
        $this->editReturnUrl($product->product_id);
        return Redirect::to($this->returnUrl);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product, ProductImage $image): RedirectResponse
{
    $filePath = $this->fileRepo . "/" . $image->image_url;
    $image->delete();
    if(Storage::disk('local')->exists($filePath)){
        Storage::disk('local')->delete($filePath);
    }
    return redirect()->back()->with('success', 'Kullanıcı başarıyla silindi.');
}
    private function editReturnUrl($id)
    {
        $this->returnUrl = "/products/$id/images";
    }
}
