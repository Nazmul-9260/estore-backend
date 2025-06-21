@extends('layouts.landing')

@section('content')
<div class="login-reg-section w-100 via-mobile-reg-section">
    <div class="text-center page-main-title-height">
        <h4 class="page-main-title">Dhaka Advanced Care Hospital</h4>
    </div>
    <div class="login-block active" id="login-container">
        <!-- Container-fluid starts -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->
                    <form id="frm_phone" class="md-float-material form-material" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="auth-box card patient-reg-card">
                            <div class="card-block">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h5 class="text-center ">Patient Login or Registration via Phone</h5>
                                    </div>
                                </div>
                                <div class="form-group form-primary phone-number-field">
                                    <label class="float-label-otp text-custom">Please join us via phone number for appointment</label>
                                    <input id="mobile" type="tel" name="mobile" class="form-control" maxlength="10" placeholder="5555566666" autofocus required>
                                    
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                    
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button id="login-form-sign-up-btn" type="submit" class="custom-btn btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20">Next</button>
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

    <div class="login-block otp-code-holder" id="register-container">
        <!-- Container-fluid starts -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <form class="md-float-material form-material" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="auth-box card patient-reg-card">
                            <div class="card-block d-flex center-center">
                                <div class="card-block-center">
                                    <div class="row m-b-20">
                                        <div class="col-md-12">
                                            <h3 class="text-center txt-primary">Enter The Code</h3>
                                        </div>
                                    </div>
                                    <div class="form-group form-primary client-otp flex-nowrap d-flex">
                                        <input type="text" name="mobile" class="form-control" autofocus required>
                                        <input type="text" name="mobile" class="form-control" autofocus required>
                                        <input type="text" name="mobile" class="form-control" autofocus required>
                                        <input type="text" name="mobile" class="form-control" autofocus required>
                                    </div>
                                
                                    <div class="row m-t-30">
                                        <div class="col-md-6 m-auto">
                                            <button id="register-form-sign-up-btn" type="submit" class="custom-btn btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Send</button>
                                        </div>
                                    </div>
                                    <a href="#" class="again-send-otp">Send OTP Again</a>
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
            let ccode = $(".selected-dial-code").text()
            console.log(ccode)
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


        $(function () {
            var code = ""; // Assigning value from model.
            $('#mobile').val(code);
            $('#mobile').intlTelInput({
                autoHideDialCode: true,
                autoPlaceholder: "ON",
                dropdownContainer: document.body,
                formatOnDisplay: true,
               // hiddenInput: "full_number",
                initialCountry: "bd",
              //  nationalMode: true,
                placeholderNumberType: "MOBILE",
                onlyCountries: ["bd","in"],
                preferredCountries: [''],
                separateDialCode: true
            });
            $('#btn-submit').on('click', function () {
                var code = $("#mobile").intlTelInput("getSelectedCountryData").dialCode;
                var phoneNumber = $('#mobile').val();
              //  $('#mobile').val(code+phoneNumber);
                //  alert('Country Code : ' + code + '\nPhone Number : ' + phoneNumber );
                document.getElementById("code").innerHTML = code;
                document.getElementById("mobile-number").innerHTML = phoneNumber;
            });
        });

    })
</script>

@endpush