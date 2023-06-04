@extends('layouts.main')

@push('style')
  <link rel="stylesheet" href="{{ asset('/css/user/field.css') }}">
@endpush

@section('body')
  @include('components.nav_responsive2')
  @include('components.navbar2')

  {{-- Spasi --}}
  <section id="spasi">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12"></div>
      </div>
    </div>
  </section>

  {{-- Booking --}}
  <section id="booking">
    <div class="container">
      <div class="row card my-3">
        <div class="col-md-12 text-center card-header">
          <h1>Lapangan Futsall</h1>
        </div>
        <div class="col-md-12 card-body">
          <img class="rounded-3" src="{{ asset('/images/lapangan1.jpg') }}" alt="img" width="100%"
            height="200px" />
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12 table-responsive">
                <table class="table">
                  @php
                    use Carbon\Carbon;
                    $today = Carbon::now()->locale('id_ID');
                  @endphp
                  <thead>
                    <tr>
                      @for ($i = 0; $i < 7; $i++)
                        @php
                          $date = $i === 0 ? $today : $today->addDay();
                          $formattedDate = $date->isoFormat('D MMM');
                          $dayName = $date->isoFormat('dddd');
                        @endphp
                        <th scope="col">
                          <div class="form-check ps-0">
                            <input class="form-check-input" type="radio" name="date" id="hari{{ $i + 1 }}"
                              value="{{ Carbon::parse($date)->format('Y-m-d') }}" required
                              @if ($select_date == $date->format('Y-m-d')) checked @endif />
                            <label class="form-check-label w-100" for="hari{{ $i + 1 }}">
                              <form action="{{ route('admin.booking.show_date', ['field' => $field->id]) }}"
                                method="get">
                                <input type="hidden" name="select_date" value="{{ $date->format('Y-m-d') }}">
                                <button type="submit" class="btn btn-info" style="width: 100%"
                                  onclick="selectButton('hari{{ $i + 1 }}')">
                                  <p class="fw-bold mb-0 fs-5 h-100">{{ $dayName }}</p>
                                  <p class="mb-0">{{ $formattedDate }}</p>
                                </button>
                              </form>
                            </label>
                          </div>
                        </th>
                      @endfor
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-12 ">
                    <div class="container">
                      <div class="row align-items-center text-center">
                        @foreach ($times as $time)
                          <div class="col-md-3 mb-3 col-6 ">
                            <div class="from-check">
                              <label class="form-check-label w-100" for="time{{ $time->id }}">
                                <button type="button" style="width: 100%" class="btn btn-info
                                @foreach ($bookings as $booking) 
                                  @if ($time->clock == $booking->start_time && $booking->status == "Confirmed")
                                    bg-dark
                                  @endif
                                @endforeach 
                                ">
                                  {{ \Carbon\Carbon::parse($time->clock)->format('H:i') }}
                                  -
                                  {{ \Carbon\Carbon::parse($time->clock)->addHour()->format('H:i') }}
                                </button>
                              </label>
                            </div>
                          </div>
                        @endforeach
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  @push('script')
    <script src="{{ asset('js/style.js') }}"></script>
  @endpush
@endsection
