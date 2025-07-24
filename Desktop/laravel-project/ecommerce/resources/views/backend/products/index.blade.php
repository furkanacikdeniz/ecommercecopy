@extends("backend.shared.backend_theme")
    @section("title","Ürün Modülü")
    @section("subtitle","Ürünler")
    @section("btn_url",url("/products/create"))
    @section("btn_label","Yeni Ekle")
    @section("btn_icon","plus")

    @section("content")

    <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Sıra No</th>
        <th>Ürün Adı</th>
        <th>Kategori</th>
        <th>Fiyat</th>
        <th>Eski Fiyat</th>
        <th>Durum</th>
        <th>İşlemler</th>
      </tr>
    </thead>
    <tbody>
        @if (count($products) > 0)

        @foreach ($products as $product)
          <tr id="{{ $product->product_id }}">
            <td>{{ $loop->iteration }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->category->name  }}</td>
            <td>{{ $product->price  }}</td>
            <td>{{ $product->old_price  }}</td>
            <td>
                @if ($product->is_active==1)
                    <span class="badge text-bg-success">Active</span>
                @else
                    <span class="badge text-bg-danger">Passive</span>
                @endif
            </td>
            <td>
              <ul class="nav d-flex gap-2">
                <li class="nav-item">
                    <a class="nav-link list-item-delete text-black" href="{{ route('products.edit', $product->product_id) }}">
                     <span data-feather="edit"></span> Güncelle
                    </a>
                </li>
                <li class="nav-item">
                  <form action="{{ route('products.destroy', $product->product_id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <a class="nav-link list-item-delete text-black" type="submit" onclick="return confirm('Silmek istediğinize emin misiniz?')">
                        <span data-feather="trash-2"></span>
                        Sil</button>
                </li>
                <li class="nav-item">
                    <a class="nav-link list-item-delete text-black" href="{{ url("/products/$product->product_id/images") }}">
                        <span data-feather="image"></span> Fotoğraflar
                    </a>
                </li>

              </ul>
            </td>
          </tr>
        @endforeach
      @else
        <tr>
          <td colspan="7" class="text-center">Kayıt bulunamadı.</td>
        </tr>
      @endif
    </tbody>
  </table>
    @endsection
