@extends('layouts.main')

@push('style')
  {{-- <link rel="stylesheet" href="{{ asset('/css/admin/field') }}"> --}}
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
      <div class="row shadow py-3">
        <div class="col-3">
          <div><img src="{{ asset('/images/lapangan1.jpg') }}" alt="img" class="rounded-2" height=" 150px" /></div>
        </div>
        <div class="col-6 text-center align-self-center">
          <h3>Informasi Booking</h3>
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
                    <td>{{ $booking->field->name }}</td>
                  </tr>
                  <tr>
                    <td>Kategori</td>
                    <td>:</td>
                    <td>{{ $booking->field->category->name }}</td>
                  </tr>
                  <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td>{{ $booking->date }}</td>
                  </tr>
                  <tr>
                  <tr>
                    <td>Nama Pemesan</td>
                    <td>:</td>
                    <td>{{ $booking->costumer_name }}</td>
                  </tr>
                  <tr>
                    <td>Waktu</td>
                    <td>:</td>
                    <td>
                      {{ $booking->start_time }}
                      -
                      {{ $booking->end_time }}
                    </td>
                  </tr>
                  <tr>
                    <td>Nomor Telepon</td>
                    <td>:</td>
                    <td>{{ $booking->phone }}</td>
                  </tr>
                  <tr>
                    <td>Status</td>
                    <td>:</td>
                    <td>
                      <button
                        class="btn
                        @if ($booking->status == 'Pending') btn-warning
                        @elseif ($booking->status == 'Waiting For Payment')
                          btn-secondary
                        @elseif ($booking->status == 'Confirmed')
                          btn-success
                        @elseif ($booking->status == 'Cancelled')
                          btn-danger @endif
                      btn-sm dropdown-toggle py-0 px-2"
                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @if ($booking->status == 'Pending')
                          Pending
                        @elseif ($booking->status == 'Waiting For Payment')
                          Tunggu Pembayaran
                        @elseif ($booking->status == 'Confirmed')
                          Confirmed
                        @elseif ($booking->status == 'Cancelled')
                          Cancelled
                        @endif
                      </button>
                      <ul class="dropdown-menu">
                        <li>
                          <form action="{{ route('admin.booking.update', ['booking' => $booking->id]) }}" method="post">
                            @method('patch')
                            @csrf
                            <input type="hidden" name="status" value="Waiting For Payment">
                            <button type="submit" class="dropdown-item">Tunggu Pembayaran</button>
                          </form>
                        </li>
                        <li>
                          <form action="{{ route('admin.booking.update', ['booking' => $booking->id]) }}" method="post">
                            @method('patch')
                            @csrf
                            <input type="hidden" name="status" value="Confirmed">
                            <button type="submit" class="dropdown-item">Terima</button>
                          </form>
                        </li>
                        <li>
                          <form action="{{ route('admin.booking.update', ['booking' => $booking->id]) }}" method="post">
                            @method('patch')
                            @csrf
                            <input type="hidden" name="status" value="Cancelled">
                            <button type="submit" class="dropdown-item">Tolak</button>
                          </form>
                        </li>
                      </ul>
                    </td>
                  </tr>
                  <tr>
                    <td>Bukti Pembayaran</td>
                    <td>:</td>
                    <td>
                      @if ($booking->confirm_payment)
                        <img src="{{ asset('storage/'. $booking->confirm_payment) }}" alt="" class="img-fluid">                        
                      @else
                        Belum Melakukan Pembayaran
                      @endif
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <a href="{{ route('admin.booking.index') }}">
              <p><i class="bi bi-arrow-left"></i> Back</p>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
