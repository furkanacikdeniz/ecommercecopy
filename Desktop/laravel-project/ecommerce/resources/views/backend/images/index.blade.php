@extends("backend.shared.backend_theme")
    @section("title","Ürünler Modülü")
    @section("subtitle","Fotoğraflar")
    @section("btn_url", url("/products/{$product->product_id}/images/create"))

    @section("btn_label","Yeni Ekle")
    @section("btn_icon","plus")

    @section("content")

    <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Sıra No</th>
        <th>Fotoğraf</th>
        <th>Açıklama</th>
        <th>Durum</th>
        <th>İşlemler</th>
      </tr>
    </thead>
    <tbody>
        @if (count($product->images) > 0)

        @foreach ($product->images as $image)
          <tr id="{{ $image->image_id }}">
            <td>{{ $image->seq }}</td>
            <td>{{ $image->image_url }}</td>
            <td>{{ $image->alt }}</td>
            <td>
                @if ($image->is_active)
                    <span class="badge text-bg-success">Aktif</span>
                @else
                    <span class="badge text-bg-danger">Pasif</span>
                @endif
            </td>
            <td>
              <ul class="nav d-flex gap-2">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url("/products/$product->product_id/images/$image->image_id/edit") }}">
                     <span data-feather="edit"></span> Güncelle
                    </a>
                </li>
                <li class="nav-item">
                  <form action="{{ url("/products/$product->product_id/images/$image->image_id") }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Silmek istediğinize emin misiniz?')" class="btn btn-danger">Sil</button>
                </li>

              </ul>
            </td>
          </tr>
        @endforeach
      @else
        <tr>
          <td colspan="5" class="text-center">Herhangi bir kayıt bulunamadı.</td>
        </tr>
      @endif
    </tbody>
  </table>
    @endsection
