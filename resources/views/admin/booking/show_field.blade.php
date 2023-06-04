@extends('layouts.main')

@push('style')
  <link rel="stylesheet" href="{{ asset('/css/user/field.css') }}">
@endpush

@section('body')
  @include('components.nav_responsive2')
  @include('components.navbar2')
  @php
    use Carbon\Carbon;
    $today = Carbon::now()->locale('id_ID')->format('Y-m-d');
  @endphp
  {{-- Spasi --}}
  <section id="spasi">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
        </div>
      </div>
    </div>
  </section>

  {{-- Lapangan --}}
  <section id="lapangan">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center py-3">
          <h1>Periksa Jadwal Tersedia di Lapangan</h1>
        </div>
      </div>
      <div class="row">
        @foreach ($fields as $field)
          <div class="col-md-3 py-2 px-0 px-2">
            <form action="{{ route('admin.booking.show_date', ['field' => $field->id]) }}" method="get">
              <input type="hidden" name="select_date" value="{{ $today }}">
              <button type="submit" class="border-0 bg-transparent">
                {{-- <a href="{{ route('admin.booking.show_date', ['field' => $field->id]) }}"> --}}
                <div class="card">
                  <div class="px-2 pt-2">
                    <img src="{{ asset('/images/lapangan1.jpg') }}" class="card-img-top rounded-3" alt="img"
                      height="170px" />
                  </div>
                  <div class="card-body">
                    <h5 class="card-title text-center">{{ $field->name }}</h5>
                    <p class="card-text">{{ $field->category->name }}</p>
                  </div>
                </div>
                {{-- </a> --}}
              </button>
            </form>
          </div>
        @endforeach
      </div>
    </div>
  </section>
@endsection
