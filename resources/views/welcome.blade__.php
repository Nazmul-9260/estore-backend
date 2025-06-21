<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1" />
        <meta name="descriptison" content="Saffron E-Store" />
        <meta name="keywords" content="Saffropn E-Store" />
        <meta name="author" content="Vrishank Softtech" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"/>
        <!-- Site Title -->
        <title>Dhaka Advanced Care Hospital</title>
        <!-- Site Favicon -->
        <!-- <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/ico" /> -->
        <!-- Required Fremwork -->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/images/favicon.ico')}}">
        <!-- Bootstrap CSS -->
        <!-- <link rel="stylesheet" href="assets/css/bootstrap.min.css" /> -->
        <!-- Required Fremwork -->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap/css/bootstrap-l.min.css')}}">
        <!-- Icofont Icons -->
        <link rel="stylesheet" href="{{asset('assets/css/icofont.min.css')}}">
        <!-- Google Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700&amp;display=swap" type="text/css" />
        <!-- Custom  CSS -->
        <!-- <link rel="stylesheet" href="assets/css/style.css" /> -->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style_landing.css')}}">
    </head>

    <body>

    	<div class="header-top-area">
    		<div class="header-top-bar container">
    			<div class="header-top-left d-flex flex-wrap align-items-center">
    				<ul class="d-flex flex-wrap">
    					<li><a href="#">CAREER</a></li>
    					<li><a href="#">FIND A DOCTOR</a></li>
    					<li><a href="mailto:info@hms.com.bd">info@hms.com.bd</a></li>
    				</ul>
    				<a href="#" class="btn btn-call"><i class="fa fa-phone"></i> 10555</a>
    			</div>
    			<div class="header-social d-flex flex-wrap align-items-center">
    				<a href="#" target="_blank"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
    				<a href="#" target="_blank"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
    				<a href="#" target="_blank"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
    				<a href="#" target="_blank"><i class="fa fa-pinterest-square" aria-hidden="true"></i></a>
    			</div>
    		</div>
    	</div>

        <!--Start Navbar-->

        <nav class="navbar navbar-expand-lg fixed-top custom-nav sticky d-block">
            <div class="container">
                <!-- LOGO -->
                <a class="navbar-brand brand-logo mr-4" href="/" style="font-size:20px; font: weight 800px;">
                    <!-- <img src="images/logo.png" class="img-fluid logo-light" alt="LOGO" />
                    <img src="images/logo-dark.png" class="img-fluid logo-dark" alt="LOGO" /> -->
                    DHAKA ADVANCED CARE HOSPITAL
                </a>
                <div class="navbar-collapse collapse justify-content-center" id="navbarCollapse">
                    <ul class="navbar-nav navbar-center" id="mySidenav">
                        <li class="nav-item active">
                            <a href="#" class="nav-link">Home</a>
                        </li>

                       
                        <li class="nav-item dropdown">
                            <!-- <a href="#" class="nav-link">Departments</a> -->
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					          Departments
					        </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        		<a class="dropdown-item" href="#">Cardiology</a>
                        		<a class="dropdown-item" href="#">Clinical Hematology</a>
                        		<a class="dropdown-item" href="#">Clinical Services Division</a>
                        		<a class="dropdown-item" href="#">Colorectal Surgery</a>
                        		<a class="dropdown-item" href="#">Corporate Affairs</a>
                        	</div>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">Doctors List</a>
                        </li>

                      
                    </ul>
                </div>

                <div class="contact_btn d-flex flex-nowrap gap-2">
                    <a href="{{url('/appointment')}}" class="btn btn-sm appointment-link">Appointment</a>
                    <a href="{{url('/login-via-phone')}}" class="btn btn-sm">Patient Login</a>
                    <button class="navbar-toggler ml-2 p-0" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="icofont-navigation-menu"></i>
                    </button>
                </div>
            </div>
        </nav>

        <!-- End Navbar -->

        <!-- Home Start-->

        <section class="bg-gradient overflow-hidden home-section" id="home">
            <div class="waves-bg home-bg">
                <div class="container">
                    <div class="w-100">
                        <div class="item">
                            <div class="row align-items-center">
                            	<div class="col-md-6">
                                    <div class="img-fadeInRight">
                                        <img src="{{asset('assets/images/hero1.webp')}}" class="img-fluid" alt="" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="content-fadeInUp d-flex justify-content-end">
                                    	<div class="content-box-wrap">
	                                        <h2>How Can We Help?</h2>
	                                        <div class="banner-quick-link">
	                                        	<a href="{{url('/step-form')}}" target="_blank">Request an Appointment <i class="fa fa-angle-right" aria-hidden="true"></i></a>
	                                        	<a href="#" target="_blank">Find a Doctor <i class="fa fa-angle-right" aria-hidden="true"></i></a>
	                                        	<a href="#" target="_blank">Login To Download Report <i class="fa fa-angle-right" aria-hidden="true"></i></a>
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

        <!-- Home End -->

        <section class="filter_area mt-0">
            <div class="container">
                <div class="section-title text-center mb-4">
                    <h2>Select Your Doctors</h2>
                </div>
                <!-- Filter Buttons -->
                <div class="filters row justify-content-center">
                    <div class="col-md-3">
                        <select class="filter-select form-control" id="first-select">
                            <option data-filter="">All Departments</option>
                            <option data-filter=".category1">Cardiology</option>
                            <option data-filter=".category2">Neurology</option>
                            <option data-filter=".category3">Orthopedics</option>
                            <option data-filter=".category4">Urology</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <select class="filter-select form-control" id="second-select">
                            <option>All Doctors</option>
                            <option data-filter=".SohailAhmed">Dr. Sohail Ahmed</option>
                            <option data-filter=".ZulfiqurHaider">Dr. Md. Zulfiqur Haider</option>
                            <option data-filter=".MahbubarRahman">Dr. Khandker Mahbubar Rahman</option>
                            <option data-filter=".MAli">Dr. M. Ali</option>
                            <option data-filter="AmitKapoor">Dr. Amit Kapoor</option>
                            <option data-filter=".ZahidHasan">Dr. M. Zahid Hasan</option>
                        </select>
                    </div>

                </div>

                <!-- Grid of items to filter -->
                <div class="grid row">
                    <div class="col-md-4 grid-item category1 SohailAhmed">
                        <div class="dept-box">
                            <div>
                                <img src="{{asset('assets/images/doctor/doctor1.jpg')}}" alt="" class="w-100">    
                            </div>
                            <div class="dept-details">
                                <div class="round-style"></div>
                                <i class="icon icofont-heart-beat-alt"></i>
                                <h4>Dr. Sohail Ahmed</h4>
                                <p class="details"><span>MBBS, MCPS (Surgery), MS (Cardiothoracic & Vascular Surgery)</span></p>
                                <a href="{{url('/step-form')}}" class="thm-btn">Make Appointment</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 grid-item category1 ZulfiqurHaider">
                        <div class="dept-box">
                            <div>
                                <img src="{{asset('assets/images/doctor/doctor2.jpg')}}" alt="" class="w-100">    
                            </div>
                            <div class="dept-details">
                                <div class="round-style"></div>
                                <i class="icon icofont-heart-beat-alt"></i>
                                <h4>Dr. Md. Zulfiqur Haider</h4>
                                <p class="details"><span>MBBS, MS (Cardiothoracic & Vascular Surgery)</span></p>
                        
                                <a href="{{url('/step-form')}}" class="thm-btn">Make Appointment</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 grid-item category2 MahbubarRahman">
                        <div class="dept-box">
                            <div>
                                <img src="{{asset('assets/images/doctor/doctor3.jpg')}}" alt="" class="w-100">    
                            </div>
                            <div class="dept-details">
                                <div class="round-style"></div>
                                <i class="icon icofont-autism"></i>
                                <h4>Dr. Khandker Mahbubar Rahman</h4>
                                <p class="details"><span>MBBS, MD (Neurology)</span></p>
                               
                                <a href="{{url('/step-form')}}" class="thm-btn">Make Appointment</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 grid-item category3 MAli">
                        <div class="dept-box">
                            <div>
                                <img src="{{asset('assets/images/doctor/doctor5.jpg')}}" alt="" class="w-100">    
                            </div>
                            <div class="dept-details">
                                <div class="round-style"></div>
                                <i class="icon icofont-crutch"></i>
                                <h4>Dr. M. Ali</h4>
                                <p class="details"><span>MBBS, MS (Ortho.)</span></p>
                               
                                <a href="{{url('/step-form')}}" class="thm-btn">Make Appointment</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 grid-item category3 AmitKapoor">
                        <div class="dept-box">
                            <div>
                                <img src="{{asset('assets/images/doctor/doctor4.jpg')}}" alt="" class="w-100">    
                            </div>
                            <div class="dept-details">
                                <div class="round-style"></div>
                                <i class="icon icofont-crutch"></i>
                                <h4>Dr. Amit Kapoor</h4>
                                <p class="details"><span>MBBS, MS (Ortho.)</span></p>
                              
                                <a href="{{url('/step-form')}}" class="thm-btn">Make Appointment</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 grid-item category4 ZahidHasan">
                        <div class="dept-box">
                            <div>
                                <img src="{{asset('assets/images/doctor/doctor6.jpg')}}" alt="" class="w-100">    
                            </div>
                            <div class="dept-details">
                                <div class="round-style"></div>
                                <i class="icon icofont-crutch"></i>
                                <h4>Dr. M. Zahid Hasan</h4>
                                <p class="details"><span>MBBS, MS (Urology)</span></p>
                                
                                <a href="{{url('/step-form')}}" class="thm-btn">Make Appointment</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Start Footer -->

        <footer class="footer bg-gradient overflow-hidden" id="footer">
            <div class="container footer-bottom">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <div class="w-100">
                            <ul class="footer-social list-inline m-0">
                                <li class="list-inline-item">
                                    <a href="#" class="social-icon"><i class="fa fa-facebook"></i></a>
                                </li>

                                <li class="list-inline-item">
                                    <a href="#" class="social-icon"><i class="fa fa-twitter"></i></a>
                                </li>

                                <li class="list-inline-item">
                                    <a href="#" class="social-icon"><i class="fa fa-instagram"></i></a>
                                </li>

                                <li class="list-inline-item">
                                    <a href="#" class="social-icon"><i class="fa fa-linkedin"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-5 col-sm-6">
                        <ul class="footer-menu list-unstyled mb-0 d-flex flex-wrap">
                            <li><a href="{{ route('login') }}">Home</a></li>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Departments</a></li>
                            <li><a href="#">Our Team</a></li>
                            <li><a href="{{ route('login') }}">Admin Login</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <div class="footer-desc">
                            <p class="mb-0 text-center">2024 &copy; <span class="font-weight-bold">SCL. </span>Design by SCL</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- <script src="assets/js/jquery.min.js"></script> -->
        <!-- <script src="assets/js/bootstrap.min.js"></script> -->
        <script type="text/javascript" src="{{asset('assets/js/jquery/jquery.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/bootstrap/js/bootstrap.min.js')}} "></script>
        <!-- start filter js -->
        <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/5.0.0/imagesloaded.pkgd.min.js"></script>
        <script>
            $(document).ready(function() {
                // Initialize Isotope with the default filter set to .category1 (Cardiology)
                var $grid = $('.grid').isotope({
                    itemSelector: '.grid-item',
                    layoutMode: 'fitRows',
                    // filter: '.category1' // Default to show Cardiology
                });

                // Ensure Isotope is properly laid out after all images are loaded
                $grid.imagesLoaded().progress(function() {
                    $grid.isotope('layout');
                });

                // Filter items when the first select dropdown changes
                $('#first-select').on('change', function() {
                    var filterValue = $(this).find('option:selected').attr('data-filter');
                    $grid.isotope({ filter: filterValue });
                });

                // Filter items when the second select dropdown changes
                $('#second-select').on('change', function() {
                    var filterValue = $(this).find('option:selected').attr('data-filter');
                    $grid.isotope({ filter: filterValue });
                });
            });
        </script>
        <!-- end filter js -->
        <script>
            /*----ONSCROLL JS-----*/
            $(window).on("scroll", function () {
                "use strict";
                var sections = $('section'),
                    nav = $('.navbar-nav'),
                    nav_height = nav.outerHeight() + 25;
                $(window).scrollTop() >= 10 ? $("nav").addClass("sticky-header") : $(".sticky").removeClass("sticky-header");
            })
        </script>
    </body>
</html>