@extends("backend.shared.backend_theme")
    @section("title","Kullanıcı Adres Modülü")
    @section("subtitle","Tüm Kullanıcı Adresleri")
    @section("btn_url", url("/users/{$user->user_id}/addresses/create"))

    @section("btn_label","Yeni Ekle")
    @section("btn_icon","plus")

    @section("content")

    <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Sıra No</th>
        <th>Şehir</th>
        <th>İlçe</th>
        <th>PostaKodu</th>
        <th>Açık Adres</th>
        <th>Varsayılan</th>
        <th>İşlemler</th>
      </tr>
    </thead>
    <tbody>
        @if ($addrs->count() > 0)

        @foreach ($addrs as $addr)
          <tr id="{{ $addr->address_id }}">
            <td>{{ $loop->iteration }}</td>
            <td>{{ $addr->city }}</td>
            <td>{{ $addr->district }}</td>
            <td>{{ $addr->zipcode }}</td>
            <td>{{ $addr->address }}</td>
            <td>
                @if ($addr->is_default)
                    <span class="badge text-bg-success">Evet</span>
                @else
                    <span class="badge text-bg-danger">Hayır</span>
                @endif
            </td>
            <td>
              <ul class="nav d-flex gap-2">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url("/users/$user->user_id/addresses/$addr->address_id/edit") }}">
                     <span data-feather="edit"></span> Güncelle
                    </a>
                </li>
                <li class="nav-item">
                  <form action="{{ url("/users/$user->user_id/addresses/$addr->address_id") }}" method="POST" style="display:inline;">
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
          <td colspan="7" class="text-center">Herhangi bir adres bulunamadı.</td>
        </tr>
      @endif
    </tbody>
  </table>
    @endsection
