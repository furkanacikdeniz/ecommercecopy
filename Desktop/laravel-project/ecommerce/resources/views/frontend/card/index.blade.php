<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E-ticaret projesi</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-body-tertiary" >
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Ecommerce</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="/">Anasayfa</a>
                            </li>
                            @auth()
                            <li class="nav-item">
                                <a class="nav-link" href="/sepetim">Hesabım</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="cikis">Çıkış</a>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="giris">Giriş Yap</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="uye-ol">Üye Ol</a>
                            </li>
                            @endauth

                        </ul>
                    </div>
    </div>
</nav>
        <div class="row">
        <div class="col-sm-3 pt-4">
            <h5>Hesabım</h5>
            <div class="list-group">
                <a href="/sepetim" class="list-group-item list-group-item-action">Sepetim</a>
            </div>
        </div>
        <div class="col-sm-9 pt-4">
            <h5>Sepetim</h5>
            @if(count($card->details) > 0)
                <table class="table">
                    <thead>
                    <th>Fotoğraf</th>
                    <th>Ürün</th>
                    <th>Adet</th>
                    <th>Fiyat</th>
                    <th>İşlemler</th>
                    </thead>
                    <tbody>
                    @foreach($card->details as $detail)
                        <tr>
                            <td>
                                <img src="{{asset("/storage/products/".$detail->product->images[0]->image_url)}}"
                                     alt="{{$detail->product->images[0]->alt}}" width="100">
                            </td>
                            <td>{{ $detail->product->name }}</td>
                            <td>{{ $detail->quantity }}</td>
                            <td>{{ $detail->product->price }}</td>
                            <td>
                                <a href="/sepetim/sil/{{$detail->card_detail_id}}">Sepetten Sil</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <a href="/satin-al" class="btn btn-success float-end">Satın Al</a>
            @else
                <p class="text-danger text-center">Sepetinizde ürün bulunamadı.</p>
            @endif
        </div>
    </div>
</div>
</body>
</html>
