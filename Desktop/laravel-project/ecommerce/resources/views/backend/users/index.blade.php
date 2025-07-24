@extends("backend.shared.backend_theme")
    @section("title","Kullanıcı Modülü")
    @section("subtitle","Yeni Kullanıcı Ekle")
    @section("btn_url",url("/users/create"))
    @section("btn_label","Yeni Ekle")
    @section("btn_icon","plus")

    @section("content")

    <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Sıra No</th>
        <th>Ad Soyad</th>
        <th>Eposta</th>
        <th>Durum</th>
        <th>İşlemler</th>
      </tr>
    </thead>
    <tbody>
        @if (!empty($users) && count($users) > 0)

        @foreach ($users as $user)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                @if ($user->is_active)
                    <span class="badge text-bg-success">Active</span>
                @else
                    <span class="badge text-bg-danger">Passive</span>
                @endif
            </td>
            <td>
              <ul class="nav d-flex gap-2">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('users.edit', $user->user_id) }}">
                     <span data-feather="edit"></span> Güncelle
                    </a>
                </li>
                <li class="nav-item">
                  <form action="{{ route('users.destroy', $user->user_id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Silmek istediğinize emin misiniz?')" class="btn btn-danger">Sil</button>
                    </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url("/users/$user->user_id/change-password") }}">
                        <span data-feather="lock"></span> Şifre Değiştir
                    </a>

                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url("/users/$user->user_id/addresses") }}">
                        <span data-feather="map-pin"></span> Adreslerim
                    </a>
                </li>
              </ul>
            </td>
          </tr>
        @endforeach
      @else
        <tr>
          <td colspan="5" class="text-center">Kullanıcı bulunamadı.</td>
        </tr>
      @endif
    </tbody>
  </table>
    @endsection
