<!doctype html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Giriş Yapın</title>

    <link rel="stylesheet" href="{{asset("css/app.css")}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-4 offset-4">
            <main class="mt-5">
                <form method="POST" action="{{url("/giris")}}">
                    @csrf
                    <h1 class="h3 mb-3 fw-normal">Giriş Yapın</h1>

                    <div class="form-group mt-2">
                        <x-input label="Eposta giriniz" placeholder="Eposta giriniz" field="email" type="email"/>
                    </div>

                    <div class="form-group mt-2">
                        <x-input label="Şifre Giriniz" placeholder="Şifre giriniz" field="password" type="password"/>
                    </div>

                    <div class="form-group  mb-3 mt-2">
                        <x-checkbox field="remember_me" label="Beni Hatırla"/>
                    </div>
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Giriş</button>
                </form>
            </main>
        </div>
    </div>
</div>
</body>
</html>
