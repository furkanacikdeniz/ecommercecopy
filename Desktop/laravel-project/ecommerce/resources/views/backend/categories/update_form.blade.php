@extends("backend.shared.backend_theme")
    @section("title","Kategori Modülü")
    @section("subtitle","Kategori Güncelle")
    @section("btn_url",url()->previous())
    @section("btn_label","Geri Dön")
    @section("btn_icon","arrow-left")

    @section("content")

  <form action="{{ route('categories.update', $category->category_id) }}" method="POST" autocomplete="off" >
    @csrf
    @method("PUT")
    <input type="hidden" name="category_id" value="{{$category->category_id}}">
    <div class="row" >
        <div class="col-lg-6 mb-3">
            <x-input label="Kategori Adı" placeholder="Kategori Adı giriniz" field="name" value="{{ $category->name }}"/>
                @error("name")
                <span class="text-danger">{{$message}}</span>
                @enderror
        </div>
        <div class="col-lg-6 mb-3">
            <x-input label="Slug" placeholder="Slug giriniz" field="slug" type="text" value="{{ $category->slug }}"/>
                @error("slug")
                <span class="text-danger">{{$message}}</span>
                @enderror
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 mb-3">
            <x-checkbox label="Aktif kategori" field="is_active" checked="{{$category->is_active==1}}" />
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-3">
            <button type="submit" class="btn btn-success">Kaydet</button>
        </div>
    </div>
</form>
@endsection
