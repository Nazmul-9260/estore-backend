@extends('layouts.master-patient')

@section('content')

<div class="page-body custom-main-body">

    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <h5>Appointment Token</h5>
                </div>
                <div class="token-container">
                    <div class="token-header">
                        <h2>Appointment Token</h2>
                        <h4>Token No: <span>#00123</span></h4>
                    </div>
                    <div class="token-body">
                        <h5>Appointment Details:</h5>
                        <p><strong>Prof. Dr. Brig. Gen. Nazimuddin</strong> (Evening) For Jahangir Tuesday</p>
                        <p><strong>Department:</strong> Medicine</p>
                        <p><strong>Date and time:</strong> 22-10-2024 Room-303 Unit-1 Pls Attend at 4:36 pm</p>
                        <p><strong>Address:</strong> Popular Diagnostic Mirpur</p>
                    </div>
                    
                    <div class="token-footer">
                        <button onclick="printToken()" class="btn btn-success">Print Token</button>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5>Patient Profile</h5>
                </div>
                 <div class="card-block table-border-style material-tab-area">
                    <!-- Row start -->
                    <div class="row m-b-30">
                        <div class="col-lg-12 col-xl-12">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs md-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#Setting" role="tab">Profile Setting</a>
                                    <div class="slide"></div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#Password" role="tab">Change Password</a>
                                    <div class="slide"></div>
                                </li>
    
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content card-block form-material p-t-20">
                                <div class="tab-pane active" id="Setting" role="tabpanel">
                                    <form id="formuser" action="#">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group form-default">
                                                    <input id="FirstName" type="text" name="name" class="form-control">
                                                    <span class="form-bar"></span>
                                                    <label class="float-label">First Name</label>
                                                    <small class="error-msg"></small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-default">
                                                    <input id="LastName" type="text" name="name" class="form-control">
                                                    <span class="form-bar"></span>
                                                    <label class="float-label">Last Name</label>
                                                    <small class="error-msg"></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group form-default">
                                            <input id="Email" type="text" name="email" class="form-control">
                                            <span class="form-bar"></span>
                                            <label class="float-label">Email</label>
                                            <small class="error-msg"></small>
                                        </div>
                                        <div class="form-group form-default">
                                            <input id="PhoneNumber" type="text" name="Phone" class="form-control">
                                            <span class="form-bar"></span>
                                            <label class="float-label">Phone Number</label>
                                            <small class="error-msg"></small>
                                        </div>
                                        <div class="col-md-3 p-0">
                                            <div class="form-group mt-2">
                                                <button type="submit" class="custom-btn btn btn-primary btn-md btn-block waves-effect waves-light text-center">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="Password" role="tabpanel">
                                    <form id="formuserpass" action="#">
                                        <div class="form-group form-default">
                                            <input id="OldPassword" type="password" name="footer-email" class="form-control">
                                            <span class="form-bar"></span>
                                            <label class="float-label">Old Password</label>
                                            <small class="error-msg"></small>
                                        </div>
                                        <div class="form-group form-default">
                                            <input id="NewPassword" type="password" name="footer-email" class="form-control">
                                            <span class="form-bar"></span>
                                            <label class="float-label">New Password</label>
                                            <small class="error-msg"></small>
                                        </div>
                                        <div class="form-group form-default">
                                            <input id="ConfirmPassword" type="password" name="footer-email" class="form-control">
                                            <span class="form-bar"></span>
                                            <label class="float-label">New Password (Confirm)</label>
                                            <small class="error-msg"></small>
                                        </div>
                                        <div class="col-md-3 p-0">
                                            <div class="form-group mt-2">
                                                <button type="submit" class="custom-btn btn btn-primary btn-md btn-block waves-effect waves-light text-center">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
            
                            </div>
                        </div>
                    </div>
                    <!-- Row end -->
                </div>


                
            </div>
        </div>
    </div>



</div>



@endsection

@push('scripts')



<script>
    function printToken() {
        // Get the content of the token-container
        var content = document.querySelector('.token-container').outerHTML;

        // Open a new window
        var printWindow = window.open('', '_blank', 'width=600,height=800');

        // Write the HTML content for the print window
        printWindow.document.open();
        printWindow.document.write(`
            <html>
                <head>
                    <title>Print Token</title>
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
                    <style>
                        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
                        .token-container { max-width: 450px; margin: auto; padding: 25px; border: 1px solid #ddd; border-radius: 8px; }
                        .token-header h2 { color: #000; }
                        .token-header h4 { color: #000; }
                        .token-body { margin-top: 10px; }
                        .token-body h5 { color: #000; }
                        @media print {.token-footer { display: none; }}
                    </style>
                </head>
                <body onload="window.print(); setTimeout(() => window.close(), 500);">
                    ${content}
                </body>
            </html>
        `);
        printWindow.document.close();
    }
</script>

<script>
    $(document).ready(function(){
        $('.multipleSelect2').select2({
            placeholder: 'Select Roles'
        });
    })
</script>

<script>
    $(document).ready(function () {
       
        $('#tabs-nav a:first').addClass('active');
        $('.tab-content:first').addClass('active');

        
        $('#tabs-nav a').click(function (event) {
            event.preventDefault();
            $('#tabs-nav a').removeClass('active');
            $('.tab-content').removeClass('active');

            $(this).addClass('active');
            var activeTab = $(this).attr('href');
            $(activeTab).addClass('active');
        });

       
        $('.dropdown-item').click(function (event) {
            event.preventDefault();
            $('#tabs-nav a').removeClass('active');
            $('.tab-content').removeClass('active');

            var activeTab = $(this).attr('href');
            $(activeTab).addClass('active');
        });
    });

    $(document).ready(function(){
        $('ul.md-tabs li:first-child a').addClass('active');
    });


</script>
<script>
    $(document).ready(function () {
        var form = $("#formuser");

        form.on("submit", function (event) {
            var isValid = true;

            // Get input fields
            var firstName = $("#FirstName");
            var lastName = $("#LastName");
            var email = $("#Email");
            var phoneNumber = $("#PhoneNumber");

            // Clear previous errors
            clearError(firstName);
            clearError(lastName);
            clearError(email);
            clearError(phoneNumber);

            // Validate First Name
            if (firstName.val().trim() === "") {
                showError(firstName, "First Name is required.");
                isValid = false;
            }

            // Validate Last Name
            if (lastName.val().trim() === "") {
                showError(lastName, "Last Name is required.");
                isValid = false;
            }

            // Validate Email (basic format validation)
            var emailPattern = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;
            if (!emailPattern.test(email.val())) {
                showError(email, "Please enter a valid email.");
                isValid = false;
            }

            // Validate Phone Number (basic non-empty check)
            if (phoneNumber.val().trim() === "") {
                showError(phoneNumber, "Phone Number is required.");
                isValid = false;
            }

            // Prevent form submission if validation fails
            if (!isValid) {
                event.preventDefault();
            }
        });

        // Function to show an error
        function showError(input, message) {
            var formGroup = input.closest(".form-group");
            var errorMsg = formGroup.find(".error-msg");

            formGroup.addClass("error");
            errorMsg.text(message).css("color", "red").show();
        }

        // Function to clear an error
        function clearError(input) {
            var formGroup = input.closest(".form-group");
            var errorMsg = formGroup.find(".error-msg");

            formGroup.removeClass("error");
            errorMsg.text("").css("color", "").hide();
        }
    });

</script>

<script>
   $(document).ready(function () {
        var form = $("#formuserpass");

        form.on("submit", function (event) {
            var isValid = true;

            // Get input fields
            var oldPassword = $("#OldPassword");
            var newPassword = $("#NewPassword");
            var confirmPassword = $("#ConfirmPassword");

            // Clear previous errors
            clearError(oldPassword);
            clearError(newPassword);
            clearError(confirmPassword);

            // Validate Old Password (ensure it's not empty)
            if (oldPassword.val().trim() === "") {
                showError(oldPassword, "Old Password is required.");
                isValid = false;
            }

            // Validate New Password (ensure it's at least 8 characters long)
            if (newPassword.val().length < 8) {
                showError(newPassword, "New Password must be at least 8 characters long.");
                isValid = false;
            }

            // Validate Confirm Password (must match the New Password)
            if (confirmPassword.val() !== newPassword.val()) {
                showError(confirmPassword, "Passwords do not match.");
                isValid = false;
            }

            // Prevent form submission if validation fails
            if (!isValid) {
                event.preventDefault();
            }
        });

        // Function to show an error
        function showError(input, message) {
            var formGroup = input.closest(".form-group");
            var errorMsg = formGroup.find(".error-msg");

            formGroup.addClass("error");
            errorMsg.text(message).css("color", "red");
        }

        // Function to clear an error
        function clearError(input) {
            var formGroup = input.closest(".form-group");
            var errorMsg = formGroup.find(".error-msg");

            formGroup.removeClass("error");
            errorMsg.text("").css("color", "");
        }
    });

</script>










@endpush