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
          <h3>Booking & Show Lapangan</h3>
          <p>Melihat lapangan yang tersedia & Melihat Pesanan</p>
        </div>
        <div class="col-md-4">
          <a href="{{ route('admin.booking.show_field') }}"><button type="button" class="btn btn-primary">Lihat
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
                  <th>Tanggal</th>
                  <th class="col-md-5">No. Telepon</th>
                  <th class="col-md-5">Nama</th>
                  <th class="col-md-5">Status</th>
                  <th class="col-md-1">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($bookings as $booking)
                  <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $booking->date }}</td>
                    <td>{{ $booking->phone }}</td>
                    <td>{{ $booking->costumer_name }}</td>
                    <td>
                      {{-- <span class="badge text-bg-warning">panding</span> --}}
                      <button
                        class="btn
                        @if ($booking->status == 'Pending') btn-warning
                        @elseif ($booking->status == 'Waiting For Payment')
                          btn-secondary
                        @elseif ($booking->status == 'Confirmed')
                          btn-success
                        @elseif ($booking->status == 'Cancelled')
                          btn-danger 
                        @endif
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
                    <td>
                      <div class="btn-group">
                        <a href="{{ route('admin.booking.show', ['booking' => $booking->id]) }}"><span
                            class="badge text-bg-info">Informasi</span></a>
                        <a href="#">
                          <span class="badge text-bg-danger ms-2" data-bs-toggle="modal"
                            data-bs-target="#deleteModal">Delete</span>
                        </a>
                      </div>
                    </td>
                  </tr>
                  <!-- Modal Delete-->
                  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="deleteModalLabel">Peringatan</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">Apakah anda yakin ingin booking {{ $booking->costumer_name }}?</div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                          <form action="{{ route('admin.booking.destroy', ['booking' => $booking->id]) }}" method="post">
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
