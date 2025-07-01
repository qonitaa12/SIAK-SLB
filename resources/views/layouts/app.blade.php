<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SIAK SLB </title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{url ('assets/vendors/feather/feather.css')}}">
    <link rel="stylesheet" href="{{url ('assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{url ('assets/vendors/ti-icons/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{url ('assets/vendors/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{url ('assets/vendors/typicons/typicons.css')}}">
    <link rel="stylesheet" href="{{url ('assets/vendors/simple-line-icons/css/simple-line-icons.css')}}">
    <link rel="stylesheet" href="{{url ('assets/vendors/css/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="{{url ('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{url ('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url ('assets/js/select.dataTables.min.css')}}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{url ('assets/css/style.css')}}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{url ('assets/images/logo-mini.svg')}}" />
    @yield('css')
  </head>
  <body class="with-welcome-text">
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
          <div class="me-3">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
              <span class="icon-menu"></span>
            </button>
          </div>
          <div>
            <a class="navbar-brand brand-logo" href="index.html">
              <img src="assets/images/logo.svg" alt="logo" />
            </a>
            <a class="navbar-brand brand-logo-mini" href="index.html">
              <img src="assets/images/logo-mini.svg" alt="logo" />
            </a>
          </div>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-top">
          <ul class="navbar-nav ms-auto">
    @if(session()->has('nama'))
        <li class="nav-item dropdown d-none d-lg-block user-dropdown">

            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                <div class="dropdown-header text-center">
                    <img class="img-md rounded-circle" src="{{ url('assets/images/faces/face8.jpg') }}" alt="Profile image">
                    <p class="mb-1 mt-3 fw-semibold">{{ session('nama') }}</p>
                    <p class="fw-light text-muted mb-0">{{ session('username') }}</p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item">
                        <i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Keluar
                    </button>
                </form>
            </div>
        </li>
    @endif
</ul>

          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    @foreach ($menus->whereNull('parent_id')->sortBy('order_by') as $menu)
      @if ($menu->role_id == session('role_id'))
        <li class="nav-item">
          <a class="nav-link" 
             @if($menus->where('parent_id', $menu->id)->where('role_id', session('role_id'))->isNotEmpty()) 
               data-bs-toggle="collapse" 
               href="#menu-{{ $menu->id }}" 
               aria-expanded="false" 
               aria-controls="menu-{{ $menu->id }}" 
             @else 
               href="{{ url($menu->url) }}" 
             @endif>
            @if ($menu->icon)
              <i class="{{ $menu->icon }}"></i>
            @endif
            <span class="menu-title">{{ $menu->name }}</span>
            @if($menus->where('parent_id', $menu->id)->where('role_id', session('role_id'))->isNotEmpty())
              <i class="menu-arrow"></i>
            @endif
          </a>

          @if($menus->where('parent_id', $menu->id)->where('role_id', session('role_id'))->isNotEmpty())
            <div class="collapse" id="menu-{{ $menu->id }}">
              <ul class="nav flex-column sub-menu">
                @foreach ($menus->where('parent_id', $menu->id)->where('role_id', session('role_id'))->sortBy('order_by') as $child)
                  <li class="nav-item">
                    <a class="nav-link" href="{{ url($child->url) }}">
                      @if ($child->icon)
                        <i class="menu-icon {{ $child->icon }}"></i>
                      @endif
                      {{ $child->name }}
                    </a>
                  </li>
                @endforeach
              </ul>
            </div>
          @endif
        </li>
      @endif
    @endforeach
  </ul>
</nav>

        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-sm-12">
                <div class="home-tab">
                  <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                  @yield('content')
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              
              <span class="float-none float-sm-end d-block mt-1 mt-sm-0 text-center">Copyright © 2025 SLBN Pembina Pekanbaru. All rights reserved.</span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{url ('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{url ('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{url ('assets/vendors/chart.js/chart.umd.js') }}"></script>
    <script src="{{url ('assets/vendors/progressbar.js/progressbar.min.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{url ('assets/js/off-canvas.js') }}"></script>
    <script src="{{url ('assets/js/template.js') }}"></script>
    <script src="{{url ('assets/js/settings.js') }}"></script>
    <script src="{{url ('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{url ('assets/js/todolist.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{url ('assets/js/jquery.cookie.js') }}" type="text/javascript"></script>
    <script src="{{url ('assets/js/dashboard.js') }}"></script>
    <!-- <script src="assets/js/Chart.roundedBarCharts.js"></script> -->
    <!-- End custom js for this page-->
    @yield('js')
  </body>
</html>