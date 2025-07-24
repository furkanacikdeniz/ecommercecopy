<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Yönetim Paneli - @yield("title")</title>
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
    .main-content { margin-left: 220px; padding: 2rem; flex-grow: 1; margin-top: 30px;}
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
        @include("backend.shared.leftnav")
      </div>
    </nav>
  </div>


<!-- Main Content -->
<div class="main-content">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1 >@yield("title")</h1>
    <a href="@yield("btn_url")" class="btn btn-danger"><span data-feather="@yield("btn_icon")">
        </span>@yield("btn_label")</a>
  </div>
    <h2>@yield("subtitle")</h2>

  <div class="table-responsive">
    @yield("content")
  </div>

</div>

</form>


<!-- Feather Icons -->
<script src="https://unpkg.com/feather-icons"></script>
<script>
  feather.replace();
</script>

</body>
</html>
