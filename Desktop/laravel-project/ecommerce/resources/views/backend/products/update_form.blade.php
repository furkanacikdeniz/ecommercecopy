@extends("backend.shared.backend_theme")
    @section("title","Ürün Modülü")
    @section("subtitle","Ürünler")
    @section("btn_url",url()->previous())
    @section("btn_label","Geri Dön")
    @section("btn_icon","arrow-left")

    @section("content")

  <form action="{{ url("products/$product->product_id)")}}" method="POST" autocomplete="off" >
    @csrf
    @method("PUT")
        <div class="row">
            <div class="col-lg-6">
                <x-input label="Ürün Adı" placeholder="Ürün Adı giriniz" field="name" value="{{$product->name}}"/>
                @error("name")
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="col-lg-6">
                <label for="category_id" class="form-label">Kategori Seçiniz</label>
                <select name="category_id" id="category_id" class="form-control">
                <option value="-1">Seçiniz</option>
                @foreach($categories as $category)
                    <option value="{{$category->category_id}}">{{$category->name}}</option>
                @endforeach
                </select>
                @error("category_id")
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <x-input label="Ürün Fiyatı" placeholder="Ürün Fiyatı giriniz" field="price" value="{{$product->price}}"/>
                @error("price")
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="col-lg-6">
                <x-input label="Eski Fiyat" placeholder="Eski Fiyatı giriniz" field="old_price" value="{{$product->old_price}}"/>
                @error("old_price")
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="row">
            <div class="col-lg-12">
                <x-input label="Kısa Açıklama" placeholder="Kısa Açıklama giriniz" field="lead" value="{{$product->lead}}"/>
            </div>
            <div class="col-lg-12">

            </div>
            <div class="row">
                <div class="col-lg-6">
                    <x-checkbox label="Aktif Ürün" field="is_active" checked="{{$product->is_active==1}}"/>
                </div>
            </div>
            <div class="row">
        <div class="col-12 mt-3">
            <button type="submit" class="btn btn-success">Kaydet</button>
        </div>
    </div>
</form>
@endsection
