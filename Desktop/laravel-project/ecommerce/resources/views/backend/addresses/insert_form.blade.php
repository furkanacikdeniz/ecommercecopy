@extends("backend.shared.backend_theme")
    @section("title","Kullanıcı Adres Modülü")
    @section("subtitle","Yeni Adres Ekle")
    @section("btn_url",url()->previous())
    @section("btn_label","Geri Dön")
    @section("btn_icon","arrow-left")

    @section("content")

    <form action="{{url("/users/$user->user_id/addresses")}}" method="POST">
        @csrf
        <input type="hidden" name="user_id" value="{{$user->user_id}}">
    <div class="row">
        <div class="col-sm-3 ">
            <x-input label="Şehir" placeholder="Şehir giriniz" field="city"/>
            @error("city")
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <br>
        <div class="col-sm-3">

            <x-input label="İlçe" placeholder="İlçe giriniz" field="district"/>
            @error("district")
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">


            <x-input label="Posta Kodu" placeholder="Posta kodunuzu giriniz" field="zipcode"/>
            @error("zipcode")
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="col-sm-3">
            <x-checkbox label="Varsayılan" field="is_default" />
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <x-textarea field="address" label="Açık adres" placeholder="Açık adresinizi giriniz" />
            @error("address")
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

    </div>
    <div class="row">
        <div class="col-12 mt-3">
            <button type="submit" class="btn btn-success"> Kaydet</button>
        </div>
    </div>
  </form>
@endsection
