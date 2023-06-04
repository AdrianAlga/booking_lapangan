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

  <section id="header">
    <div class="container">
      <div class="row shadow py-3 text-center">
        <div class="col-md-3">
          <div><img src="{{ asset('storage/'.$field->image) }}" alt="img" class="rounded-2" height=" 150px" /></div>
        </div>
        <div class="col-md-6 text-center align-self-center">
          <h3>Informasi Lapangan</h3>
        </div>
      </div>
    </div>
  </section>

  <section id="informasi">
    <div class="container">
      <div class="row card shadow p-4 mt-3">
        <div class="col-md-12">
          <h4 class="card-header">Informasi</h4>
          <div class="card-body">
            <div class="col-12 col-md-6">
              <table class="table table-borderless table-responsive">
                <tbody>
                  <tr>
                    <td>Nama Lapangan</td>
                    <td>:</td>
                    <td>{{ $field->name }}</td>
                  </tr>
                  <tr>
                    <td>Kategori</td>
                    <td>:</td>
                    <td>
                      {{ $field->category->name }}
                    </td>
                  </tr>
                  <tr>
                    <td>Harga</td>
                    <td>:</td>
                    <td>
                      {{ $field->rental_price }}
                    </td>
                  </tr>
                  <tr>
                    <td>Deskripsi</td>
                    <td>:</td>
                    <td>
                      {{ $field->description }}
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <a href="{{ route('admin.field.index') }}">
              <p><i class="bi bi-arrow-left"></i> Back</p>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
