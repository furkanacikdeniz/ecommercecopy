@extends("backend.shared.backend_theme")
    @section("title","Kullanıcı Modülü")
    @section("subtitle","Şifrenizi Değiştirin")
    @section("btn_url",url()->previous())
    @section("btn_label","Geri Dön")
    @section("btn_icon","arrow-left")

    @section("content")

    <form action="{{url("/users/$user->user_id/change-password")}}" method="POST">
        @csrf
    <div class="row">
        <div class="col-sm-3">
            <x-input label="Şifre" placeholder="şifrenizi giriniz" field="password" type="password"/>
            @error("password")
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="col-sm-3">
            <x-input label="Şifre tekrarı" placeholder="şifrenizi tekrar giriniz" field="password_confirmation" type="password"/>
            @error("password_confirmation")
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
