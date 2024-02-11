<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Технический учет</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  @routes
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">

    </div>
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="{{ route('home') }}" class="btn btn-link">Главная</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <form action="{{ route('logout') }}" method="post" class="float-left">
            @csrf
            <button type="submit" class="btn btn-link">
              Выход
            </button>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
          </a>
          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>

        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <!-- <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image"> -->
          </div>
          <div class="info">
            <a href="#" class="d-block">{{ Auth()->user()->name }}</a>
          </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Поиск" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            @if (Auth()->user()->permissions->network_infrastructure)
            <li class="nav-item">
              <a href="#" class="nav-link">
                <p>
                  Сетевая инфраструктура
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <a href="pages/calendar.html" class="nav-link">
                  <p>
                    Абоненты
                    <!-- <span class="badge badge-info right">2</span> -->
                  </p>
                </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <p>
                  Элементы
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="pages/mailbox/read-mail.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Патч панели</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('telecom-cabinet.create') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Телеком. шкафы</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/mailbox/read-mail.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Коммутаторы</p>
                  </a>
                </li>
              </ul>
          </ul>
          </li>
          @endif

          @if (Auth()->user()->permissions->telephone_infrastructure)
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                Телефонная инфраструктура
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <a href="pages/calendar.html" class="nav-link">
                <p>
                  Абоненты
                  <!-- <span class="badge badge-info right">2</span> -->
                </p>
              </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                Элементы
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/mailbox/read-mail.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Патч панели</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Телеком. шкафы</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/mailbox/read-mail.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Коммутаторы</p>
                </a>
              </li>
            </ul>
            </ul>
          </li>
          @endif

          @if (Auth()->user()->permissions->storage)
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                Склад
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <a href="pages/calendar.html" class="nav-link">
                <p>
                  Вещи
                  <!-- <span class="badge badge-info right">2</span> -->
                </p>
              </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                Элементы
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/mailbox/read-mail.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Патч панели</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Телеком. шкафы</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/mailbox/read-mail.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Коммутаторы</p>
                </a>
              </li>
            </ul>
            </ul>
          </li>
          @endif

          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                Устройства и материалы
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/mailbox/read-mail.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Сетевое оборудование</p>
                </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('telecom-cabinet.index') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Телеком. шкафы</p>
                  </a>
                </li>
              <li class="nav-item">
                <a href="{{ route('building.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Оборудование</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('material.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Материалы</p>
                </a>
              </li>
            </ul>
          </li>

          @if (Auth()->user()->permissions->facilities)
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                Cооружения
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('building.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Здания</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('floor.index', ['building' => 'all']) }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Этажи</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('room.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Комноты</p>
                </a>
              </li>
            </ul>
          </li>
          @endif

          @if (Auth()->user()->permissions->reference)
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>
                Справочники
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="materials" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Подразделениея</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('material-reference.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Справочник материалов</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('floor.index', ['building' => 'all']) }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Этажи</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/mailbox/read-mail.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Комноты</p>
                </a>
              </li>
            </ul>
          </li>
          @endif

          @if (Auth()->user()->permissions->user)
          <li class="nav-item">
            <a href="{{ route('user.index') }}" class="nav-link">
              <p>
                Пользователи
              </p>
            </a>
          </li>
          @endif

          @if (Auth()->user()->permissions->setting)
          <li class="nav-item">
            <a href="{{ route('setting') }}" class="nav-link">
              <p>
                Настройки
              </p>
            </a>
          </li>
          @endif

          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
  </div>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="container mt-2">
      <div class="row">
        <div id='success' class="col-12">
          @if (session()->has('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
          @endif
        </div>
        <div class="col-12">
          @if (session()->has('error'))
          <div class="alert alert-danger">
            {{ session('error') }}
          </div>
          @endif
        </div>
      </div>
    </div>
    <!-- Content Wrapper. Contains page content -->
    @yield('content')
    <!-- /.content-wrapper -->
    <!-- /.content -->
  </div>
  <footer class="main-footer">
    <strong>2024-{{ date('Y') }}</strong>
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget('uibutton', $.ui.butt)
  </script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- daterangepicker -->
  <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
  <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
  <!-- overlayScrollbars -->
  <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('dist/js/adminlte.js') }}"></script>
  @yield('script')

</body>

</html>