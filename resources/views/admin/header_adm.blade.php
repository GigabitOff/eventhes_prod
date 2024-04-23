<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Partner | EVENTHES</title>
    <link rel="icon" type="image/png" href="{{ asset('storage/AdminLTE/fav.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('storage/AdminLTE/fav.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('storage/AdminLTE/fav.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('storage/AdminLTE/fav.png') }}">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link href="{{ asset('storage/AdminLTE/plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('storage/AdminLTE/dist/css/adminlte.min.css') }}">
    <link href="{{ asset('storage/AdminLTE/dist/css/adminlte.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('storage/AdminLTE/plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/AdminLTE/plugins/codemirror/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/AdminLTE/plugins/codemirror/theme/monokai.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/AdminLTE/plugins/simplemde/simplemde.min.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/AdminLTE/plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('storage/AdminLTE/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('storage/AdminLTE/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/AdminLTE/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('storage/AdminLTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('storage/AdminLTE/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/AdminLTE/plugins/bs-stepper/css/bs-stepper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/AdminLTE/plugins/dropzone/min/dropzone.min.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/AdminLTE/dist/css/adminlte.min.css') }}">
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-T0HSNB1YY5"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-T0HSNB1YY5');
    </script>
    <style>
        .color-palette {
            height: 35px;
            line-height: 35px;
            text-align: right;
            padding-right: .75rem;
        }

        .color-palette.disabled {
            text-align: center;
            padding-right: 0;
            display: block;
        }

        .color-palette-set {
            margin-bottom: 15px;
        }

        .color-palette span {
            display: none;
            font-size: 12px;
        }

        .color-palette:hover span {
            display: block;
        }

        .color-palette.disabled span {
            display: block;
            text-align: left;
            padding-left: .75rem;
        }

        .color-palette-box h4 {
            position: absolute;
            left: 1.25rem;
            margin-top: .75rem;
            color: rgba(255, 255, 255, 0.8);
            font-size: 12px;
            display: block;
            z-index: 7;
        }

        .sidebar {
            height: 100vh;
            overflow-z: 9999;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini" style="background-color:#f4f6f9;">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Navbar Search -->
            <table>
                <thead>
                <tr>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default">Меню</button>
                        <button type="button" class="btn btn-default dropdown-toggle dropdown-icon"
                                data-toggle="dropdown" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu" style="">
                            <a class="nav-link" href="/partner" target="_blank">
                                <i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door" viewBox="0 0 16 16">
                                        <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4z"/>
                                    </svg></i> {{ __('translate.Home') }}
                            </a>
                            <a class="nav-link" href="/all" target="_blank">
                                {{ __('translate.Events') }}
                            </a>
                            <a class="nav-link" href="/blog" target="_blank">
                                {{ __('translate.Blog') }}
                            </a>
                            <a class="nav-link" href="/contact-us" target="_blank">
                                {{ __('translate.Contact Us') }}
                            </a>

                        </div>
                    </div>
                </tr>
                </thead>
            </table>
            <li class="nav-item dropdown" style="margin-top: 3px; ">
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                         class="bi bi-door-open" viewBox="0 0 16 16">
                        <path d="M8.5 10c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1"/>
                        <path
                            d="M10.828.122A.5.5 0 0 1 11 .5V1h.5A1.5 1.5 0 0 1 13 2.5V15h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V1.5a.5.5 0 0 1 .43-.495l7-1a.5.5 0 0 1 .398.117M11.5 2H11v13h1V2.5a.5.5 0 0 0-.5-.5M4 1.934V15h6V1.077z"/>
                    </svg>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                    <i class="fas fa-search"></i>
                </a>
                <div class="navbar-search-block">
                    <form class="form-inline">
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                   aria-label="Search">
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
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge" id="alerts"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a href="/admin/users/stats"
                       class="dropdown-item dropdown-footer">{{ __('translate.See Notifications') }}</a>
                </div>
            </li>
        </ul>
    </nav>
    <aside class="main-sidebar sidebar-dark-primary elevation-4" style="height: 100%;position: fixed;">
        <!-- Brand Logo -->
        <a href="../../index3.html" class="brand-link">
            <img src="{{ asset('storage/AdminLTE/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                 class="brand-image img-circle elevation-3" style="opacity: 0.8">
            <span class="brand-text font-weight-light">EVENTHES</span>
        </a>
        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('storage/AdminLTE/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                         alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">
                            {{ $currentAdmin->name }}
                </div>
            </div>
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                           aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="/admin" class="nav-link">
                            <i class="nav-icon far">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-bar-chart-line" viewBox="0 0 16 16">
                                    <path
                                        d="M11 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h1V7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7h1zm1 12h2V2h-2zm-3 0V7H7v7zm-5 0v-3H2v3z"/>
                                </svg>
                            </i>
                            <p>
                                {{ __('translate.Statistic') }}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item" id="events">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>
                                {{ __('translate.Events') }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/admin/events/all" id="event_all" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ __('translate.All') }}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/events/create" id="event_create" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ __('translate.Create') }}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/events/settings" id="event_settings" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ __('translate.Settings') }}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/events/stats" id="event_stats" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ __('translate.Statistic') }}</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item" id="users">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-person" viewBox="0 0 16 16">
                                    <path
                                        d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                                </svg>
                            </i>
                            <p>
                                {{ __('translate.Users') }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        @php
                            $currentAdmin = Auth::user();
                        @endphp
                        @if($currentAdmin->role_id == 1)
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/admin/users/all" id="users_all" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('translate.All') }}</p>
                                    </a>
                                </li>
                            </ul>
                        @endif
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/admin/users/stats" id="users_stats" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ __('translate.Alerts') }}</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item" id="shedule">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>
                                {{ __('translate.Shedule') }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/admin/shedules/all" class="nav-link" id="shedule_all">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ __('translate.All') }}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/shedules/create" id="shedule_create" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ __('translate.Create') }}</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item" id="orders">
                        <a href="" class="nav-link">
                            <i class="nav-icon far">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-cart2" viewBox="0 0 16 16">
                                    <path
                                        d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l1.25 5h8.22l1.25-5zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0"/>
                                </svg>
                            </i>
                            <p>
                                {{ __('translate.Orders') }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/admin/orders/all" id="order_all" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ __('translate.All') }}</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item" id="pay">
                        <a href="" class="nav-link">
                            <i class="nav-icon far">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-credit-card-2-back" viewBox="0 0 16 16">
                                    <path
                                        d="M11 5.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5z"/>
                                    <path
                                        d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zm13 2v5H1V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1m-1 9H2a1 1 0 0 1-1-1v-1h14v1a1 1 0 0 1-1 1"/>
                                </svg>
                            </i>
                            <p>
                                {{ __('translate.Payments') }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/admin/payments/all" id="payment_all" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ __('translate.Transaction') }}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin/payments/create" id="payment_create" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ __('translate.Create') }}</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <div class="dropdown">
                    <img style="margin-left: 85px; margin-top: 10px; cursor: pointer;" width="16%" height="16%"
                         src="{{ asset('storage/files/' . session('locale', config('app.locale')) . '.png') }}" onclick="toggleDropdown()">
                    <div id="dropdownMenu" class="dropdown-menu" role="menu">
                        <a class="dropdown-item" href="{{ url('/lang/en') }}">English</a>
                        <a class="dropdown-item" href="{{ url('/lang/ru') }}">Русский</a>
                        <a class="dropdown-item" href="{{ url('/lang/es') }}">Español</a>
                        <a class="dropdown-item" href="{{ url('/lang/fr') }}">Français</a>
                        <a class="dropdown-item" href="{{ url('/lang/pl') }}">Polski</a>
                        <a class="dropdown-item" href="{{ url('/lang/ua') }}">Українська</a>
                        <a class="dropdown-item" href="{{ url('/lang/de') }}">Deutsch</a>
                    </div>
                </div>

                <script>
                    function toggleDropdown() {
                        var dropdownMenu = document.getElementById("dropdownMenu");
                        if (dropdownMenu.classList.contains("show")) {
                            dropdownMenu.classList.remove("show");
                        } else {
                            dropdownMenu.classList.add("show");
                        }
                    }
                </script>
            </nav>
        </div>
    </aside>
    <script>
        var currentUrl = window.location.pathname;
        if (currentUrl === "/admin" || currentUrl === "/admin/") {
            document.querySelector('.nav-item a[href="/admin"]').classList.add('active');
        }
        setInterval(function () {
            $.ajax({
                url: "{{ route('alerts.count') }}",
                method: 'GET',
                success: function (response) {
                    var count = response.count;
                    $('#alerts').text(count);

                    if (count === 0) {
                        $('#alerts').hide();
                    } else {
                        $('#alerts').show();
                    }
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        }, 2000);
    </script>








