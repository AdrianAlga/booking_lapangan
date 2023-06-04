@extends('layouts.main')

@push('style')
  <link rel="stylesheet" href="{{ asset('/css/admin/field.css') }}">
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

  <section id="header-tambahLapangan">
    <div class="container-fluid card shadow-lg">
      <div class="row mt-3">
        <div class="col-2">
          <a href="{{ route('admin.field.index') }}">
            <button type="button" class="btn btn-primary">
              <i class="bi bi-arrow-left-circle"></i>
            </button>
          </a>
        </div>
        <div class="col-12 text-center">
          <h3>Tambah Lapangan</h3>
          <p>Tambahkan Lapangan baru pada colom dibawah</p>
        </div>
      </div>
    </div>
  </section>

  <section id="addLapangan">
    <div class="container-fluid">
      <div class="row mt-4 justify-content-center">
        <div class="col-md-6  mb-3">
          <div class="card">
            <div class="login-box">
              <form action="{{ route('admin.field.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h4 class="mb-4 text-center">Lapangan</h4>
                <div class="user-box">
                  <input type="text" name="name" required="" />
                  <label class="text-black">Nama Lapangan</label>
                </div>
                <div class="user-box">
                  <input type="number" name="rental_price" required="" min="0" />
                  <label class="text-black">Harga Sewa / Jam</label>
                </div>
                <div class="mb-3">
                  <label for="formFile" class="form-label">Masukkan foto Lapangan</label>
                  <input class="form-control" name="image" type="file" id="formFile" />
                </div>
                <div class="mb-3">
                  <label for="exampleFormControlTextarea1" class="form-label">Deskripsi</label>
                  <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <div class="row">
                  <div class="col-md-5">
                    <div>
                      <label for="text-black">Pilih kategori</label>
                      <select class="form-select" name="category_id" aria-label="Default select example">
                        <option hidden>Kategori Lapangan</option>
                        @foreach ($categories as $category)
                          <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row text-center my-4">
                  <div class="col-md-12">
                    <div class="login-box">
                      <button type="submit" class="card">
                        Tambah
                        <span></span>
                      </button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
