@extends("backend.shared.backend_theme")
    @section("title","Kullanıcı Adres Modülü")
    @section("subtitle","Adres Güncelle")
    @section("btn_url",url()->previous())
    @section("btn_label","Geri Dön")
    @section("btn_icon","arrow-left")

    @section("content")

  <form action="{{ url("/products/$product->product_id/images/$image->image_id")}}" method="POST" autocomplete="off" enctype="multipart/form-data" novalidate >
    @csrf
    @method("PUT")
    <input type="hidden" name="product_id" value="{{$product->product_id}}">
    <input type="hidden" name="image_id" value="{{$image->image_id}}">
    <div class="row">
        <div class="col-lg-6">
            <label for="image_url" class="form-label">Dosya Yükle</label>
            <input type="file" class="form-control" id="image_url" name="image_url" value="{{$image->image_url}}">
            <img src="{{asset("/storage/products/$image->image_url")}}" alt="{{$image->alt}}" width="100">
            @error('image_url')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-lg-6">
            <div class="mt-2">
                <x-input label="Kısa Açıklama" placeholder="Kısa açıklama giriniz" field="alt" value="{{$image->alt}}"/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="mt-2">
                <x-input label="Sıra No" placeholder="Sıra no giriniz" field="seq" value="{{$image->seq}}"/>
            </div>
        </div>
        <div class="col-lg-6">
            <x-checkbox label="Aktif" field="is_active" checked="{{$image->is_active==1}}"/>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-3">
            <button type="submit" class="btn btn-success">Kaydet</button>
        </div>
    </div>
</form>
@endsection
