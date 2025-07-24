@extends("backend.shared.backend_theme")
    @section("title","Kategori Modülü")
    @section("subtitle","Kategoriler")
    @section("btn_url",url("/categories/create"))
    @section("btn_label","Yeni Ekle")
    @section("btn_icon","plus")

    @section("content")

    <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Sıra No</th>
        <th>Ad Soyad</th>
        <th>Slug</th>
        <th>Durum</th>
        <th>İşlemler</th>
      </tr>
    </thead>
    <tbody>
        @if (count($categories) > 0)

        @foreach ($categories as $category)
          <tr id="{{ $category->category_id }}">
            <td>{{ $loop->iteration }}</td>
            <td>{{ $category->name }}</td>
            <td>{{ $category->slug  }}</td>
            <td>
                @if ($category->is_active==1)
                    <span class="badge text-bg-success">Active</span>
                @else
                    <span class="badge text-bg-danger">Passive</span>
                @endif
            </td>
            <td>
              <ul class="nav d-flex gap-2">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('categories.edit', $category->category_id) }}">
                     <span data-feather="edit"></span> Güncelle
                    </a>
                </li>
                <li class="nav-item">
                  <form action="{{ route('categories.destroy', $category->category_id) }}" method="POST" style="display:inline;">
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
          <td colspan="5" class="text-center">Kullanıcı bulunamadı.</td>
        </tr>
      @endif
    </tbody>
  </table>
    @endsection
