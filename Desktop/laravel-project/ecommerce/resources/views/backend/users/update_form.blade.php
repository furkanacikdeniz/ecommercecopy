@extends("backend.shared.backend_theme")
    @section("title","Kullanıcı Modülü")
    @section("subtitle","Kullanıcı Güncelle")
    @section("btn_url",url()->previous())
    @section("btn_label","Geri Dön")
    @section("btn_icon","arrow-left")

    @section("content")

  <form action="{{ route('users.update', $user->user_id) }}" method="POST" autocomplete="off" >
    @csrf
    @method("PUT")
    <input type="hidden" name="user_id" value="{{$user->user_id}}">
    <div class="row" >
        <div class="col-lg-6 mb-3">
            <x-input label="Ad Soyad" placeholder="Ad Soyad giriniz" field="name" value="{{ $user->name }}"/>
                @error("name")
                <span class="text-danger">{{$message}}</span>
                @enderror
        </div>
        <div class="col-lg-6 mb-3">
            <x-input label="Eposta" placeholder="Eposta giriniz" field="email" type="email" value="{{ $user->email }}"/>
                @error("email")
                <span class="text-danger">{{$message}}</span>
                @enderror
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 mb-3">
            <x-checkbox label="Yetkili kullanıcı" field="is_admin" checked="{{$user->is_admin==1}}" />
        </div>
        <div class="col-lg-6 mb-3">
            <x-checkbox label="Aktif kullanıcı" field="is_active" checked="{{$user->is_active==1}}" />
        </div>
    </div>

    <div class="row">
        <div class="col-12 mt-3">
            <button type="submit" class="btn btn-success">Kaydet</button>
        </div>
    </div>
</form>
@endsection
