@extends('layouts.main')

@push('style')
  <link rel="stylesheet" href="{{ asset('/css/login.css') }}">
@endpush

@section('body')
  <section id="login">
    <div class="container-fluid h-100">
      <div class="row h-100 align-items-center">
        <div class="col-12">
          <div class="row justify-content-center">
            <div class="col-md-9 text-center text-white">
              <h1>Booking Lapangan</h1>
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="col-11 col-md-5">
              <div class="login-box">
                <p>Login</p>
                @if (session()->has('loginError'))
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('loginError') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif
                @include('components.alerts')

                <form action="{{ route('loginProcess') }}" method="POST">
                  @csrf
                  <div class="user-box">
                    <input required="" name="email" type="text" class="@error('email') is-invalid @enderror"
                      value="{{ old('email') }}" />
                    <label>Email</label>
                    @error('email')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  <div class="user-box">
                    <input required="" name="password" type="password" class="@error('password') is-invalid @enderror"
                      value="{{ old('password') }}" />
                    <label>Password</label>
                    @error('password')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  <button type="submit">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    Submit
                  </button>
                </form>
                <p class="regist">
                  Belum Punya Akun?
                  <a href="{{ route('regis') }}">
                    Register
                  </a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
