<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Enviro Research Publishers</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="{{ url('/')}}/admin_assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ url('/')}}/admin_assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <link href="{{ url('/')}}/admin_assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
    <!-- PLUGINS STYLES-->
    <link href="{{ url('/')}}/admin_assets/vendors/jvectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="{{ url('/')}}/admin_assets/css/main.min.css" rel="stylesheet" />
    <link href="{{ url('/')}}/admin_assets/css/main.min.css" rel="stylesheet" />
    <script src="{{ url('/')}}/admin_assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
    <script src="{{ url('/')}}/admin_assets/vendors/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
    <script src="{{ url('/')}}/admin_assets/vendors/jquery-validation/dist/additional-methods.min.js" type="text/javascript"></script>

    <link href="{{ url('/')}}/admin_assets/vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css" rel="stylesheet" />
    <link href="{{ url('/')}}/admin_assets/vendors/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" />
    <link href="{{ url('/')}}/admin_assets/css/custom.css" rel="stylesheet" />

    <script src="{{ url('/')}}/admin_assets/vendors/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <script src="{{ url('/')}}/admin_assets/vendors/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>


    <!-- PAGE LEVEL STYLES-->
    <style>
        .theme-config {
            display: none;
        }

        .page-heading .page-title {
            margin: 10px 0 10px 0;
        }

        .page-content {
            padding-top: 0px;
        }

        .red {
            color: red !important
        }

        [type=reset],
        [type=submit],
        button,
        html [type=button] {
            cursor: pointer !important;
        }
    </style>
</head>

<body class="fixed-navbar">
    <div class="page-wrapper">
        <!-- START HEADER-->
        <header class="header">
            <div class="page-brand">
                <a class="link" href="index.html">
                    <span class="brand">Admin
                        <span class="brand-tip">JMS</span>
                    </span>
                    <span class="brand-mini">AC</span>
                </a>
            </div>
            <div class="flexbox flex-1">
                <!-- START TOP-LEFT TOOLBAR-->
                <ul class="nav navbar-toolbar">
                    <li>
                        <a class="nav-link sidebar-toggler js-sidebar-toggler"><i class="ti-menu"></i></a>
                    </li>

                </ul>
                <!-- END TOP-LEFT TOOLBAR-->
                <!-- START TOP-RIGHT TOOLBAR-->
                <ul class="nav navbar-toolbar">

                    <li class="dropdown dropdown-user">
                        <a class="nav-link dropdown-toggle link" data-toggle="dropdown">
                            <img src="{{ url('/')}}/admin_assets/img/admin-avatar.png" />
                            <span></span>Admin<i class="fa fa-angle-down m-l-5"></i></a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{url('/')}}/profile" target="_blank"><i class="fa fa-user"></i>Profile</a>
                            <a class="dropdown-item" href="{{url('/')}}/admin/setting/edit/1"><i class="fa fa-cog"></i>Settings</a>
                            <a class="dropdown-item" href="#"><i class="fa fa-support"></i>Support</a>
                            <li class="dropdown-divider"></li>
                            <div style=" padding: 0px 15px;">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <i class="fa-solid fa-right-from-bracket"></i>
                                    <x-dropdown-link :href="route('logout')" style="padding: 0px !important;"
                                        onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </div>
                        </ul>
                    </li>
                </ul>
                <!-- END TOP-RIGHT TOOLBAR-->
            </div>
        </header>
        <!-- END HEADER-->