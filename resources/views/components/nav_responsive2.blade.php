@push('style')
  <link rel="stylesheet" href="{{ asset('/css/user/field.css') }}">
@endpush

<section id="navbar2">
  <div class="container-fluid">
    <nav class="navbar fixed-top color-navbar">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
          aria-controls="offcanvasNavbar">
          <span class="bi bi-text-paragraph fs-1 fw-bold"></span>
        </button>

        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar"
          aria-labelledby="offcanvasNavbarLabel" data-bs-display="push">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
              <div class="card">
                <div class="container">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('admin.field.index') }}">
                      <i class="bi bi-house-door"></i> Lapangan</a>
                  </li>
                </div>
              </div>
              <div class="card mt-2">
                <div class="container">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('admin.booking.index') }}">
                      <i class="bi bi-calendar"></i> Booking</a>
                  </li>
                </div>
              </div>
              <div class="card mt-2">
                <div class="container">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('admin.time.index') }}">
                      <i class="bi bi-clock"></i> Waktu</a>
                  </li>
                </div>
              </div>
              <div class="card mt-2">
                <div class="container">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('admin.category.index') }}">
                      <i class="bi bi-bookmarks"></i> Kategori</a>
                  </li>
                </div>
              </div>
            </ul>
          </div>
        </div>
        <div class="btn-group">
          <button type="button" class="btn dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown"
            data-bs-display="static" aria-expanded="false">
            <div class="bg-primary rounded-circle me-2 d-flex align-items-center justify-content-center icn-akun">A
            </div>
          </button>
          <ul class="dropdown-menu dropdown-menu-end">
            <li>
              <a href="{{ route('logout') }}">
                <button class="dropdown-item" type="button">Logout</button>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</section>
