@extends("backend.shared.backend_theme")
    @section("title","Ürünler Modülü")
    @section("subtitle","Fotoğraflar")
    @section("btn_url",url()->previous())
    @section("btn_label","Geri Dön")
    @section("btn_icon","arrow-left")

    @section("content")

    <form action="{{url("/products/$product->product_id/images")}}" method="POST" novalidate enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="product_id" value="{{$product->product_id}}">
    <div class="row">
        <div class="col-lg-6">
            <label for="image_url" class="form-label">Dosya Yükle</label>
            <input type="file" class="form-control" id="image_url" name="image_url">
            @error('image_url')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-lg-6">
            <div class="mt-2">
                <x-input label="Kısa Açıklama" placeholder="Kısa açıklama giriniz" field="alt"/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="mt-2">
                <x-input label="Sıra No" placeholder="Sıra no giriniz" field="seq"/>
            </div>
        </div>
        <div class="col-lg-6">
            <x-checkbox label="Aktif" field="is_active" />
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-3">
            <button type="submit"  class="btn btn-success"> <span data-feather="save"></span> Kaydet</button>
        </div>
    </div>
  </form>
@endsection
