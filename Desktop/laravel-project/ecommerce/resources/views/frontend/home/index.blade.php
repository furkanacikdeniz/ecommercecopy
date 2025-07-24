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
                                <a class="nav-link" href="/sepetim">SEPETİM</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="cikis">Çıkış</a>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="giris">Griş Yap</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="uye-ol">Üye OL</a>
                            </li>
                            @endauth

                        </ul>
                    </div>
    </div>
</nav>
        <div class="row" >
            <div class="col-sm-3 pt-4">
                <h5>Kategoriler</h5>
                <div class="list-group">
                    @if (count($categories) > 0)
                        @foreach ($categories as $category)

                                <a href="/category/{{$category->slug}}" class="list-group-item list-group-item-action">{{$category->name}}</a>

                        @endforeach

                    @endif
                </div>
            </div>
            <div class="col-sm-9 ">
                <h5>Ürünler</h5>
                    @if (count($products) > 0)
                    <div class="card-group">
                        @foreach ($products as $product)
                            <div class="card" style="width: 18rem;">
                                @if ($product->images && $product->images->first())
    <img src="{{ asset('storage/products/' . $product->images->first()->image_url) }}">
@else
    <img src="{{ asset('storage/products/default.png') }}">
@endif


                                <div class="card-body">
                                    <h5 class="card-title">{{$product->name}}</h5>
                                    <p class="card-text">{{$product->lead}}</p>
                                    <a href="/sepetim/ekle/{{$product->product_id}}" class="btn btn-primary">Sepete Ekle</a>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript" src="{{asset('js/app.js')}}"></script>
</html>
