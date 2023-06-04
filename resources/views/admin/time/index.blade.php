@extends('layouts.main')

@push('style')
  <link rel="stylesheet" href="{{ asset('/css/admin/field') }}">
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
    <div class="container-fluid card shadow">
      <div class="row p-3">
        <div class="col-md-12">
          <h3>Time</h3>
          <p>menambah, mengedit, atau menghapus Waktu</p>
        </div>
        <div class="col-md-4">
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Add
            Time</button>
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
                  <th class="col-md-7">Waktu</th>
                  <th class="col-md-5">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($times as $time)
                  <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>
                      {{ \Carbon\Carbon::parse($time->clock)->format('H:i') }}
                      -
                      {{ \Carbon\Carbon::parse($time->clock)->addHour()->format('H:i') }}
                    </td>
                    <td>
                      <button class="badge text-bg-warning border-0" data-bs-toggle="modal"
                        data-bs-target="#editModal{{ $time->id }}">
                        Edit Waktu
                      </button>
                      <button class="badge text-bg-danger border-0" data-bs-toggle="modal"
                        data-bs-target="#deleteModal{{ $time->id }}">
                        Delete
                      </button>
                    </td>
                  </tr>
                  <!-- Modal Edit -->
                  <form action="{{ route('admin.time.update', ['time' => $time->id]) }}" method="POST">
                    @method('patch')
                    @csrf
                    <div class="modal fade" id="editModal{{ $time->id }}" tabindex="-1"
                      aria-labelledby="editModal{{ $time->id }}Label" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="editModal{{ $time->id }}Label">Edit Waktu</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <div class="mb-3">
                              <label for="exampleFormControlInput1" class="form-label">Time</label>
                              <input type="time" name="clock" class="form-control" id="exampleFormControlInput1"
                                value="{{ $time->clock }}" required>
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

                  <!-- Modal Deleter-->
                  <div class="modal fade" id="deleteModal{{ $time->id }}" tabindex="-1"
                    aria-labelledby="deleteModal{{ $time->id }}Label" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="deleteModal{{ $time->id }}Label">Peringatan</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">Apakah anda yakin ingin menghapusnya?</div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                          <form action="{{ route('admin.time.destroy', ['time' => $time->id]) }}" method="POST">
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
    <!-- Modal Tambah -->
    <form action="{{ route('admin.time.store') }}" method="POST">
      @csrf
      <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="createModalLabel">Tambah Waktu</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Time</label>
                <input type="time" name="clock" class="form-control" id="exampleFormControlInput1" required>
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
