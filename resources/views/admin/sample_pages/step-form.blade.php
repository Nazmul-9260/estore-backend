<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1" />
        <meta name="descriptison" content="" />
        <meta name="keywords" content="" />
        <meta name="author" content="" />
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
        <!-- datepicker -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
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

        <section class="step_area">
            <div class="container">
                <div class="section-title text-center mb-4">
                    <h2>Doctor Appointment</h2>
                </div>
                <div class="row">
                    <div class="col-md-4 grid-item">
                        <div class="dept-box">
                            <div>
                                <img src="http://127.0.0.1:8000/assets/images/doctor/doctor1.jpg" alt="" class="w-100">    
                            </div>
                            <div class="dept-details">
                                <div class="round-style"></div>
                                <i class="icon icofont-heart-beat-alt"></i>
                                <h4>Dr. Sohail Ahmed</h4>
                                <p class="details"><span>MBBS, MCPS (Surgery), MS (Cardiothoracic &amp; Vascular Surgery)</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 grid-item">
                         <div class="step_content_wrap">
                            <!-- Step Progress Bar -->
                            <div class="progress-container">
                                <div class="progress-step active">
                                    <div class="step-circle">1</div>
                                    <p>Step 1</p>
                                </div>
                                <div class="progress-step">
                                    <div class="step-circle">2</div>
                                    <p>Step 2</p>
                                </div>
                                <div class="progress-step">
                                    <div class="step-circle">3</div>
                                    <p>Step 3</p>
                                </div>
                            </div>
                            <form id="stepForm">
                                <!-- Step 1 -->
                                <div class="step active" id="step1">
                                    <h5>Select Appointment Date And Time</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">First Name:</label>
                                                <input type="text" id="name" class="form-control" placeholder="Enter First Name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Last Name:</label>
                                                <input type="text" id="name" class="form-control" placeholder="Enter Last Name" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="date">Choose a Date:</label>
                                                <input type="text" class="form-control" id="datepicker" placeholder="Select Date">
                                                <i class="fa calendar-icon fa-calendar"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="date">Choose a Time</label>
                                                <select class="form-control">
                                                    <option>Select Time</option>
                                                    <option>8am-10am</option>
                                                    <option>12am-1pm</option>
                                                    <option>2pm-3pm</option>
                                                    <option>6pm-8pm</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Step 2 -->
                                <div class="step" id="step2">
                                    <h5>Please provide your phone number</h5>
                                    <div class="form-group">
                                        <label for="email">Phone Number:</label>
                                        <input id="mobile" type="tel" name="mobile" class="form-control" maxlength="10" placeholder="5555566666" autofocus required>
                                    </div>
                                </div>

                                <!-- Step 3 -->
                                <div class="step" id="step3">
                                    <h5 class="text-center">Enter The Code</h5>
                                    <div class="card-block-center pt-2">
                                        <div class="form-group form-primary client-otp flex-nowrap d-flex">
                                            <input type="text" name="mobile" class="form-control" autofocus="" required="">
                                            <input type="text" name="mobile" class="form-control" autofocus="" required="">
                                            <input type="text" name="mobile" class="form-control" autofocus="" required="">
                                            <input type="text" name="mobile" class="form-control" autofocus="" required="">
                                        </div>
                                        <div class="text-center"><a href="#" class="again-send-otp">Send OTP Again</a></div>
                                    </div>
                                </div>

                                <!-- Navigation buttons -->
                                <div class="step-navigation">
                                    <button type="button" id="prevBtn" class="btn btn-secondary" style="display: none;">Previous</button>
                                    <button type="button" id="nextBtn" class="btn btn-primary">Next</button>
                                    <button type="submit" id="submitBtn" class="btn btn-success" style="display: none;">Submit</button>
                                </div>
                            </form>
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

        <script type="text/javascript" src="{{asset('assets/js/jquery/jquery.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/bootstrap/js/bootstrap.min.js')}} "></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
        <script type="text/javascript" src="{{asset('assets/js/intlTelInput.min.js')}}"></script>
        <!-- datepicker -->
        <script>
            $(document).ready(function() {
                // Initialize the datepicker
                 $('#datepicker').datepicker({
                    format: 'mm/dd/yyyy', // Date format
                    autoclose: true,      // Automatically close the datepicker after selecting a date
                    todayHighlight: true,  // Highlight today's date
                    startDate: new Date()  // Disable previous dates
                });

                 //phone number jquery
                 var code = ""; // Assigning value from model.
                $('#mobile').val(code);
                $('#mobile').intlTelInput({
                    autoHideDialCode: true,
                    autoPlaceholder: "ON",
                    dropdownContainer: document.body,
                    formatOnDisplay: true,
                    initialCountry: "bd",
                    placeholderNumberType: "MOBILE",
                    onlyCountries: ["bd","in"],
                    preferredCountries: [''],
                    separateDialCode: true
                });
            });
        </script>

        <!-- step form -->
        <script>
            $(document).ready(function() {
                var currentStep = 1; // Track the current step
                var totalSteps = $('.step').length; // Total number of steps

                // Function to show/hide steps based on current step
                function showStep(step) {
                    $('.step').removeClass('active').hide(); // Hide all steps
                    $('#step' + step).addClass('active').fadeIn(); // Show the current step

                    // Update progress bar
                    $('.progress-step').each(function(index) {
                        if (index + 1 < step) {
                            $(this).addClass('completed').removeClass('active');
                        } else if (index + 1 === step) {
                            $(this).addClass('active').removeClass('completed');
                        } else {
                            $(this).removeClass('active completed');
                        }
                    });

                    // Show/hide navigation buttons
                    if (step === 1) {
                        $('#prevBtn').hide();
                        $('#nextBtn').show();
                        $('#submitBtn').hide();
                    } else if (step === totalSteps) {
                        $('#prevBtn').show();
                        $('#nextBtn').hide();
                        $('#submitBtn').show();
                    } else {
                        $('#prevBtn').show();
                        $('#nextBtn').show();
                        $('#submitBtn').hide();
                    }
                }

                // Handle Next button click
                $('#nextBtn').click(function() {
                    if (currentStep < totalSteps) {
                        currentStep++;
                        showStep(currentStep);
                    }
                });

                // Handle Previous button click
                $('#prevBtn').click(function() {
                    if (currentStep > 1) {
                        currentStep--;
                        showStep(currentStep);
                    }
                });

                // Handle form submission
                $('#stepForm').submit(function(e) {
                    e.preventDefault();
                    alert('Form submitted!');
                });

                // Initialize the first step
                showStep(currentStep);
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