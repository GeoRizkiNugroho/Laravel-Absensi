<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>@yield('title', 'Student App')</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{ asset('#') }}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;500&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">


  <!-- Main CSS File -->
  <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('assets/css/css.css')}}">
  <style>
   /* EDIT */
.editBtn {
  width: 55px;
  height: 55px;
  border-radius: 20px;
  border: none;
  background-color: rgb(93, 93, 116);
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.123);
  cursor: pointer;
  position: relative;
  overflow: hidden;
  transition: all 0.3s;
}
.editBtn::before {
  content: "";
  width: 200%;
  height: 200%;
  background-color: rgb(102, 102, 141);
  position: absolute;
  z-index: 1;
  transform: scale(0);
  transition: all 0.3s;
  border-radius: 50%;
  filter: blur(10px);
}
.editBtn:hover::before {
  transform: scale(1);
}
.editBtn:hover {
  box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.336);
}

.editBtn svg {
  height: 17px;
  fill: white;
  z-index: 3;
  transition: all 0.2s;
  transform-origin: bottom;
}
.editBtn:hover svg {
  transform: rotate(-15deg) translateX(5px);
}
.editBtn::after {
  content: "";
  width: 25px;
  height: 1.5px;
  position: absolute;
  bottom: 19px;
  left: -5px;
  background-color: white;
  border-radius: 2px;
  z-index: 2;
  transform: scaleX(0);
  transform-origin: left;
  transition: transform 0.5s ease-out;
}
.editBtn:hover::after {
  transform: scaleX(1);
  left: 0px;
  transform-origin: right;
}

/* DELETE */
.deleteButton {
  width: 55px;
  height: 55px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 3px;
  background-color: transparent;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  transition: all 0.2s;
  position: relative;
  overflow: hidden;
}
.deleteButton svg {
  width: 44%;
}
.deleteButton:hover {
  background-color: rgb(237, 56, 56);
  overflow: visible;
}
.bin path {
  transition: all 0.2s;
}
.deleteButton:hover .bin path {
  fill: #fff;
}
.deleteButton:active {
  transform: scale(0.98);
}
.tooltip {
  --tooltip-color: rgb(41, 41, 41);
  position: absolute;
  top: -40px;
  background-color: var(--tooltip-color);
  color: white;
  border-radius: 5px;
  font-size: 12px;
  padding: 8px 12px;
  font-weight: 600;
  box-shadow: 0px 10px 10px rgba(0, 0, 0, 0.105);
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
  transition: all 0.5s;
}
.tooltip::before {
  position: absolute;
  width: 10px;
  height: 10px;
  transform: rotate(45deg);
  content: "";
  background-color: var(--tooltip-color);
  bottom: -10%;
}
.deleteButton:hover .tooltip {
  opacity: 1;
}

/* FD */

  </style>

</head>

<body class="starter-page-page">

    <header id="header" class="header d-flex align-items-center sticky-top" style="background-color: whitesmoke;border-bottom:2px solid black; ">
        <div class="container position-relative d-flex align-items-center justify-content-between">
          <a href="{{route('home')}}" class="logo d-flex align-items-center me-auto me-xl-0">
            <h1 class="sitename">Student Data</h1>
            <span>.</span>
          </a>

          @if (Auth::check())
          <nav id="navmenu" class="navmenu">
              <ul>
                <li><a href="{{route('attendances.index')}}">Absensi</a></li>
                @if (Auth::user()->role == 'admin')
                <li><a href="{{ route('student.home') }}">Data Siswa</a></li>
                  <li><a href="{{ route('user.index') }}">Kelola Akun</a></li>
                @endif
                <li><a href="{{ route('logout') }}">Logout</a></li>
              </ul>
              <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
          </nav>
          @endif

        </div>
      </header>
      <main class="main" >
        <div class="container mt-5">
      @yield('content')
        </div>
      </main>






  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

  @stack('script')

</body>
</html>


