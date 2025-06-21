<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!--[if lt IE 10]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <meta name="keywords" content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
    <meta name="author" content="AshikMeherMobin" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

       
    <!-- Favicon icon -->
    <link rel="icon" href="{{asset('assets/images/favicon.ico')}}" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
    <!-- waves.css -->
    <link rel="stylesheet" href="{{asset('assets/pages/waves/css/waves.min.css')}}" type="text/css" media="all">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap/css/bootstrap.min.css')}}">
    <!-- waves.css -->
    <link rel="stylesheet" href="{{asset('assets/pages/waves/css/waves.min.css')}}" type="text/css" media="all">
    <!-- themify icon -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/icon/themify-icons/themify-icons.css')}}">
    <!-- font-awesome-n -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/icon/icofont/css/icofont.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/font-awesome-n.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/font-awesome.min.css')}}">
    <!-- scrollbar.css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/jquery.mCustomScrollbar.css')}}">
    <!-- include animate css-->
    <link href="{{asset('assets/css/animate.css/css/animate.css')}}" rel="stylesheet">
    <!-- include notification css-->
    <link href="{{asset('assets/pages/notification/notification.css')}}" rel="stylesheet">

    <!-- include summernote css-->
    <link href="{{asset('css/summernote/summernote.min.css')}}" rel="stylesheet">
    {{-- <link href="{{asset('assets/css/summernote.min.css')}}" rel="stylesheet"> --}}
    <!-- include datepicker css-->
    <link href="{{asset('assets/css/bootstrap-datepicker.css')}}" rel="stylesheet">
    <!-- Datatable -->
    <link rel="stylesheet" href="{{asset('DataTables/datatables.min.css')}}">
    <!-- Toastr -->
    <link href="{{ asset('assets/css/toastr.css') }}" rel="stylesheet">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
    <!-- Sweetalert2 -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}">
    <!-- morris chart -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/morris.js/css/morris.css')}}">
    <!-- MyStyles.css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/mystyles.css')}}">

    {{-- <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/44.1.0/ckeditor5.css" /> --}}
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/44.1.0/ckeditor5.css" crossorigin>
           

</head>

<body>
    @include('sweetalert::alert')
    <!-- Pre-loader start -->
    @include('layouts.partials.preloader')
    <!-- Pre-loader end -->

    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            <!-- Topbar start -->
            @include('layouts.partials.topbar')
            <!-- Topbar end -->

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">

                    <!-- Sidebar start -->
                    @include('layouts.partials.sidebar')
                    <!-- Sidebar end -->

                    <div class="pcoded-content">



                        <!-- Page-header start -->
                        @include('layouts.partials.header', ['pageTitle'=> 'Saffron E-Store'])
                        <!-- Page-header end -->

                        <div class="pcoded-inner-content">
                            <!-- Main-body start -->
                            <div class="main-body">
                                <div class="page-wrapper">

                                    <!-- Page-body start -->
                                    @yield('content')
                                    <!-- Page-body end -->

                                </div>
                                <div id="styleSelector"> </div>
                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>

    @include('layouts.partials.copyright')
    @include('layouts.partials.footer')
    @stack('scripts')