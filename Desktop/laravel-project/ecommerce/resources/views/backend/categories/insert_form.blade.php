@extends("backend.shared.backend_theme")
    @section("title","Kategori Modülü")
    @section("subtitle","Yeni Kategori Ekle")
    @section("btn_url",url()->previous())
    @section("btn_label","Geri Dön")
    @section("btn_icon","arrow-left")

    @section("content")

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-6">

                <x-input label="Kategori Adı" placeholder="Kategori Adı giriniz" field="name"/>
                @error("name")
                    <span class="text-danger">{{$message}}</span>
                @enderror
                <x-input label="Slug" placeholder="Slug giriniz" field="slug"/>
                @error("slug")
                    <span class="text-danger">{{$message}}</span>
                @enderror

            </div>
        <div class="col-lg-6">
            <x-checkbox label="Aktif kategori" field="is_active" />
        </div>
    </div>

    <div class="row">
        <div class="col-12 mt-3 ml-3">
            <button type="submit" class="btn btn-success"> Kaydet</button>
        </div>
    </div>
  </form>
@endsection
