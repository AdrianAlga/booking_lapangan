@extends('layouts.main')

@push('style')
  <link rel="stylesheet" href="{{ asset('/css/admin/field.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/admin/table.css') }}">
@endpush

@section('body')
  @include('components.nav_responsive2')
  @include('components.navbar2')

  {{-- Spasi --}}
  <section id="spasi_admin">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12"></div>
      </div>
    </div>
  </section>

  <section id="headerLapangan">
    <div class="container-fluid card shadow">
      <div class="row p-3">
        <div class="col-md-12">
          <h3>Kategori</h3>
          <p>menambah, mengedit, atau menghapus Kategori</p>
        </div>
        <div class="col-md-4">
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Add
            Kategori</button>
        </div>
      </div>
    </div>
  </section>

  @include('components.alerts')

  <section class="kategori">
    <div class="container-fluid card shadow my-3">
      <div class="row">
        <div class="col-md-12 p-4">
          <div class="table-responsive">
            <table class="table table-bordered text-center">
              <thead>
                <tr>
                  <th class="col-md-0">No</th>
                  <th class="col-md-7">Nama Kategori</th>
                  <th class="col-md-5">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($categories as $category)
                  <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $category->name }}</td>
                    <td>
                      <button class="badge text-bg-warning border-0" data-bs-toggle="modal" data-bs-target="#editModal{{ $category->id }}">
                        EditKategori
                      </button>
                      <button class="badge text-bg-danger border-0"
                        data-bs-toggle="modal"data-bs-target="#deleteModal{{ $category->id }}">
                        Delete
                      </button>
                    </td>
                  </tr>
                  <!-- Modal Edit -->
                  <form action="{{ route('admin.category.update', ['category' => $category->id]) }}" method="POST">
                    @method('patch')
                    @csrf
                    <div class="modal fade" id="editModal{{ $category->id }}" tabindex="-1" aria-labelledby="editModal{{ $category->id }}Label"
                      aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="editModal{{ $category->id }}Label">Edit Kategori</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <div class="mb-3">
                              <label for="exampleFormControlInput1" class="form-label">Nama Kategori</label>
                              <input type="text" name="name" class="form-control" id="exampleFormControlInput1" value="{{ $category->name }}" required>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Ubah</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                  <!-- Modal Delete-->
                  <div class="modal fade" id="deleteModal{{ $category->id }}" tabindex="-1"
                    aria-labelledby="deleteModal{{ $category->id }}Label" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="deleteModal{{ $category->id }}Label">Peringatan</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">Apakah anda yakin ingin menghapus {{ $category->name }}?</div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                          <form action="{{ route('admin.category.destroy', ['category' => $category->id]) }}"
                            method="post">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger">Ya</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
              </tbody>
            </table>

          </div>
        </div>
      </div>
    </div>
    <!-- Modal Create -->
    <form action="{{ route('admin.category.store') }}" method="POST">
      @csrf
      <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="createModalLabel">Tambah Kategori</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nama Kategori</label>
                <input type="text" name="name" class="form-control" id="exampleFormControlInput1" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </section>

  @push('script')
    <script src="{{ asset('/js/style.js') }}"></script>
  @endpush
@endsection
