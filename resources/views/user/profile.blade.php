@php
  use Carbon\Carbon;
@endphp

@extends('layouts.main')

@push('style')
  <link rel="stylesheet" href="{{ asset('/css/user/field.css') }}">
@endpush

@section('body')
  @include('components.nav_responsive')
  @include('components.navbar')

  {{-- Spasi --}}
  <section id="spasi">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12"></div>
      </div>
    </div>
  </section>

  <section id="Informasi">
    <div class="container">
      <div class="row card">
        <div class="col-md-12 card-header text-center">
          <h1>Informasi</h1>
        </div>
        <div class="col-md-12 card-body">
          @include('components.alerts')
          <div class="table-responsive">
            <table class="table table-bordered text-center">
              <thead>
                <tr>
                  <th class="col-md-0">No.</th>
                  <th class="col-md-3">Tanggal</th>
                  <th class="col-md-3">Jam</th>
                  <th class="col-md-4">Boking Lapangan</th>
                  <th class="col-md-4">Status</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($userBooking as $booking)
                  <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ Carbon::parse($booking->date)->locale('id_ID')->isoFormat('D MMMM YYYY') }}</td>
                    <td>
                      {{ $booking->start_time }}
                      -
                      {{ $booking->end_time }}
                    </td>
                    <td>{{ $booking->field->name }} ({{ $booking->field->category->name }})</td>
                    <td>
                      @if ($booking->status == 'Pending')
                        <button class="badge text-bg-warning border-0" disabled>Pending</button>
                        <button class="badge text-bg-danger border-0" data-bs-toggle="modal"
                          data-bs-target="#modalDelete{{ $booking->id }}">
                          <i class="bi bi-trash"></i>
                        </button>
                      @elseif ($booking->status == 'Waiting For Payment')
                        <button class="badge text-bg-secondary border-0" disabled>Pay Now</button>
                        <button class="badge text-bg-danger px-3 border-0" data-bs-toggle="modal"
                          data-bs-target="#confirmModal{{ $booking->id }}">
                          <i class="bi bi-send"></i>
                        </button>
                      @elseif ($booking->status == 'Confirmed')
                        <button class="badge text-bg-success border-0" disabled>Succes</button>
                      @elseif ($booking->status == 'Cancelled')
                        <button class="badge text-bg-danger border-0" disabled>Failed</button>
                      @endif
                    </td>
                  </tr>
                  <!-- Modal Delete -->
                  <div class="modal fade" id="modalDelete{{ $booking->id }}" tabindex="-1"
                    aria-labelledby="modalDelete{{ $booking->id }}Label" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="modalDelete{{ $booking->id }}Label">Peringatan</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">Apakah Anda Yakin Ingin Menghapus?</div>
                        <div class="modal-footer">
                          <form action="{{ route('profile.destroy', ['booking' => $booking->id]) }}" method="post">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger">Hapus</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Modal confirm -->
                  <div class="modal fade" id="confirmModal{{ $booking->id }}" tabindex="-1"
                    aria-labelledby="confirmModal{{ $booking->id }}Label" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="confirmModal{{ $booking->id }}Label">Peringatan</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <div>
                            <div class="row">
                              <span class="col-5">Bank</span>
                              <span class="col-1">:</span>
                              <span class="col-5">BRI</span>
                            </div>
                            <div class="row">
                              <span class="col-5">Nomor Rekening</span>
                              <span class="col-1">:</span>
                              <span class="col-5">2208 1996 1403</span>
                            </div>
                            <div class="row">
                              <span class="col-5">Nama penerima</span>
                              <span class="col-1">:</span>
                              <span class="col-5">Shanya</span>
                            </div>
                          </div>
                          @if ($booking->confirm_payment)
                            <p class="py-3">
                              Anda telah mengirim Bukti Pemabayaran
                            </p>
                          @else
                            <form action="{{ route('profile.confirm', ['booking' => $booking->id]) }}" method="POST"
                              enctype="multipart/form-data">
                              @method('patch')
                              @csrf
                              <label for="formFile" class="form-label">Kirim Bukti Pembayaran</label>
                              <div class="d-flex">
                                <input class="form-control" type="file" name="confirm_payment" id="formFile" required />
                                <button class="btn btn-primary mx-3" type="submit">Kirim</button>
                              </div>
                            </form>
                          @endif
                        </div>
                        <div class="modal-footer pb-4">
                          <p>
                            Segera Melakukan Pembayaran dalam kurung waktu 15 Menit <br />
                            Jangan lupa komfirmasi pembayaran pada tombol send
                          </p>
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
@endsection
