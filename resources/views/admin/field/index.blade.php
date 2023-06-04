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
          <h3>Lapangan</h3>
          <p>menambah, mengedit, atau menghapus Lapangan</p>
        </div>
        <div class="col-md-4">
          <a href="{{ route('admin.field.create') }}">
            <button type="button" class="btn btn-primary">Add
              Lapangan</button>
          </a>
        </div>
      </div>
    </div>
  </section>

  @include('components.alerts')

  <section class="Lapangan">
    <div class="container-fluid card shadow my-3">
      <div class="row">
        <div class="col-md-12 p-4">
          <div class="table-responsive">
            <table class="table table-bordered text-center">
              <thead>
                <tr>
                  <th class="col-md-0">No</th>
                  <th class="col-md-4">Kategori</th>
                  <th class="col-md-4">Nama Lapangan</th>
                  <th class="col-md-4">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($fields as $field)
                  <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $field->category->name }}</td>
                    <td>{{ $field->name }}</td>
                    <td>
                      <a href="{{ route('admin.field.show', ['field' => $field->id]) }}"><span
                          class="badge text-bg-info">Informasi</span></a>
                      <a href="{{ route('admin.field.edit', ['field' => $field->id]) }}"><span
                          class="badge text-bg-warning">Edit Produk</span></a>
                      <a href="#">
                        <span class="badge text-bg-danger" data-bs-toggle="modal"
                          data-bs-target="#exampleModal{{ $field->id }}">Delete</span>
                      </a>
                    </td>
                  </tr>
                  <!-- Modal Delete-->
                  <div class="modal fade" id="exampleModal{{ $field->id }}" tabindex="-1"
                    aria-labelledby="exampleModal{{ $field->id }}Label" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModal{{ $field->id }}Label">Peringatan</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">Apakah anda yakin ingin {{ $field->name }}?</div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                          <form action="{{ route('admin.field.destroy', ['field' => $field->id]) }}" method="post">
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
  </section>

  @push('script')
    <script src="{{ asset('/js/style.js') }}"></script>
  @endpush
@endsection
