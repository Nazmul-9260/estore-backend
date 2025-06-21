@extends('layouts.landing')

@section('content')

<div class="login-reg-section w-100">
    <div class="text-center page-main-title-height">
        <h4 class="page-main-title">Dhaka Advanced Care Hospital</h4>
    </div>
    <div class="login-block" id="login-container">
        <!-- Container-fluid starts -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->
                    <form class="md-float-material form-material" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="auth-box card">
                            <div class="card-block">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-center">Sign In</h3>
                                    </div>
                                </div>
                                <div class="form-group form-primary">
                                    <input id="email" type="email" name="email" class="form-control fill @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    <span class="form-bar"></span>
                                    <label class="float-label">Email</label>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group form-primary">
                                    <input id="password" type="password" class="form-control fill @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    <span class="form-bar"></span>
                                    <label class="float-label">Password</label>
                                </div>
                                <div class="row m-t-25 text-left">
                                    <div class="col-12">
                                        <div class="checkbox-fade fade-in-primary d-">
                                            <label>
                                                <input type="checkbox" value="" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                <span class="text-inverse">Remember me</span>
                                            </label>
                                        </div>
                                        <div class="forgot-phone text-right f-right">
                                            <a href="auth-reset-password.html" class="text-right f-w-600"> Forgot Password?</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-20">
                                    <div class="col-md-12">
                                        <button id="login-form-sign-in-btn" type="submit" class="custom-btn btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20">Sign in</button>
                                    </div>

                                    <div class="col-md-12">
                                        <button id="login-form-sign-up-btn" type="button" class="custom-btn btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20">Create New</button>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="two-button-wrap d-flex flex-nowrap">
                                            <button class="btn waves-effect waves-light btn-success btn-outline-success login-with-google-btn"><i class="fa fa-google" aria-hidden="true"></i>Google</button>
                                            <button class="btn waves-effect waves-light btn-info btn-outline-info login-with-facebook-btn"><i class="fa fa-facebook" aria-hidden="true"></i>Facebook</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- end of form -->
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <footer class="main-footer">
            <h6 style="text-align: center;">&copy {{date('Y')}} Saffron Corporation Limited</h6>
        </footer>
        <!-- end of container-fluid -->
    </div>

    <div class="login-block active" id="register-container">
        <!-- Container-fluid starts -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <form class="md-float-material form-material" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="auth-box card">
                            <div class="card-block">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-center txt-primary">Sign up</h3>
                                    </div>
                                </div>
                                <div class="form-group form-primary">
                                    <input id="name" type="text" name="name" class="form-control fill @error('name') is-invalid @enderror" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    <span class="form-bar"></span>
                                    <label class="float-label">Choose Username</label>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group form-primary">
                                    <input id="email" type="email" name="email" class="form-control fill @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email">
                                    <span class="form-bar"></span>
                                    <label class="float-label">Your Email Address</label>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group form-primary">
                                            <input id="password" type="password" name="password" class="form-control fill @error('password') is-invalid @enderror" required autocomplete="new-password">
                                            <span class="form-bar"></span>
                                            <label class="float-label">Password</label>
                                        </div>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group form-primary">
                                            <input id="password-confirm" type="password" class="form-control fill" name="password_confirmation" required autocomplete="new-password">
                                            <span class="form-bar"></span>
                                            <label class="float-label">Confirm Password</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-5 text-left">
                                    <div class="col-md-12">
                                        <div class="checkbox-fade fade-in-primary">
                                            <label>
                                                <input type="checkbox" value="">
                                                <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                <span class="text-inverse">I read and accept <a href="#">Terms &amp; Conditions.</a></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-10">
                                    <div class="col-md-12">
                                        <button id="register-form-sign-up-btn" type="submit" class="custom-btn btn btn-primary btn-md btn-block waves-effect text-center m-b-10">Sign up</button>
                                    </div>
                                    <div class="col-md-12">
                                        <button id="register-form-sign-in-btn" type="button" class="custom-btn btn btn-primary btn-md btn-block waves-effect text-center m-b-10">Sign in</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="two-button-wrap d-flex flex-nowrap">
                                            <button class="btn waves-effect waves-light btn-success btn-outline-success login-with-google-btn"><i class="fa fa-google" aria-hidden="true"></i>Google</button>
                                            <button class="btn waves-effect waves-light btn-info btn-outline-info login-with-facebook-btn"><i class="fa fa-facebook" aria-hidden="true"></i>Facebook</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <footer class="main-footer">
            <h6 style="text-align: center;">&copy {{date('Y')}} Saffron Corporation Limited</h6>
        </footer>
        <!-- end of container-fluid -->
    </div>
</div>
@endsection


@push('scripts')

<script>
    $(document).ready(function() {
        console.log('ready');
        $('#login-form-sign-up-btn').click(function(e) {
            e.preventDefault();
            $('#login-container').removeClass('active');
            $('#login-container').addClass('slide-left');
            $('#register-container').addClass('active');
            $('.invalid-feedback').html('');
        })

        $('#register-form-sign-in-btn').click(function(e) {
            e.preventDefault();
            $('#register-container').removeClass('active');
            $('#login-container').addClass('active');
            $('.invalid-feedback').html('');
        })

    })
</script>

@endpush