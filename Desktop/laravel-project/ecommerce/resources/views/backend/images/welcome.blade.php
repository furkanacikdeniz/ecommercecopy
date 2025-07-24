<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Yönetim Paneli</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
  <style>
    body { margin: 0; }
    .navbar-custom { background-color: #343a40; }
    .wrapper { display: flex; margin-top: 56px; }
    .sidebar {
      width: 220px;
      background-color: #f8f9fa;
      border-right: 1px solid #dee2e6;
      padding-top: 1rem;
      height: calc(100vh - 56px);
      position: fixed;
      top: 56px;
      left: 0;
    }
    .sidebar a {
      padding: 0.75rem 1.5rem;
      display: block;
      color: #000;
      text-decoration: none;
    }
    .sidebar a:hover { background-color: #e9ecef; }
    .main-content { margin-left: 220px; padding: 2rem; flex-grow: 1; }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-dark navbar-expand-lg navbar-custom fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Laravel Ecommerce</a>
    <div class="d-flex">
      <a href="#" class="btn btn-outline-light btn-sm">Çıkış</a>
    </div>
  </div>
</nav>

<!-- Sidebar -->
<div class="sidebar">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#">
              <span data-feather="home"></span>
              Yönetim Paneli
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Str::of(url()->current())->contains('/users') ? 'active' : '' }}" href="/users">
              <span data-feather="users"></span>
              Kullanıcılar
            </a>
          </li>
        </ul>
      </div>
    </nav>
  </div>


<!-- Main Content -->
<div class="main-content">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Kullanıcılar</h3>
    <a href="/users/create" class="btn btn-danger">Yeni Ekle</a>
  </div>

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
            <td>{{ $user->is_active }}</td>
            <td>
              <ul class="nav d-flex gap-2">
                <li class="nav-item">
                  <a href="{{ url('/users/edit/'.$user->id) }}" class="btn btn-warning">Güncelle</a>

                </li>
                <li class="nav-item">
                  <a class="nav-link text-danger list-item-delete" href="/users/delete/{{ $user->user_id }}">
                    <span data-feather="trash-2"></span> Sil
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{url()/users/$user->user_id/change-password}}">
                    <span data-feather="lock"></span> Şifre Değiştir
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
</div>

<!-- Feather Icons -->
<script src="https://unpkg.com/feather-icons"></script>
<script>
  feather.replace();
</script>

</body>
</html>
