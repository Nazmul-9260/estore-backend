@extends('layouts.master-patient')

@section('content')

<div class="page-body custom-main-body">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Employee Create</h5>
                </div>
                <div class="card-block table-border-style material-tab-area employee-info">
                    <!-- Row start -->
                    <div class="row m-b-30">
                        <div class="col-lg-12 col-xl-12">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs md-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#PersonalInfo" role="tab">Personal Info</a>
                                    <div class="slide"></div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#ContactInfo" role="tab">Contact Info</a>
                                    <div class="slide"></div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#FamilyInfo" role="tab">Family Info</a>
                                    <div class="slide"></div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#CurriculumInfo" role="tab">Curriculum Info</a>
                                    <div class="slide"></div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#ImportantDocument" role="tab">Important Document</a>
                                    <div class="slide"></div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#BankInfo" role="tab">Bank Info</a>
                                    <div class="slide"></div>
                                </li>
    
                            </ul>
                            <!-- Tab panes -->
                            <form id="EmployeeCreate" action="#" class="form-material">
                                <div class="tab-content card-block p-t-20">
                                    <div class="tab-pane active" id="PersonalInfo" role="tabpanel">
                                        <div class="section-blog-card m-0 m-b-20">
                                            <h6 class="group-title">Employee Basic Info:</h6>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group form-default">
                                                        <input type="text" name="name" class="form-control" required>
                                                        <span class="form-bar"></span>
                                                        <label class="float-label">Employee Full Name<span class="text-danger">*</span></label>
                                                        <small class="error-msg"></small>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group form-default">
                                                        <input type="text" name="name" class="form-control" required>
                                                        <span class="form-bar"></span>
                                                        <label class="float-label">Employee Father Name<span class="text-danger">*</span></label>
                                                        <small class="error-msg"></small>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group form-default">
                                                        <input type="text" name="name" class="form-control" required>
                                                        <span class="form-bar"></span>
                                                        <label class="float-label">Employee Mother Name<span class="text-danger">*</span></label>
                                                        <small class="error-msg"></small>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group form-default focus-date-select">
                                                        <input id="datepicker" type="text" name="name" class="form-control" required>
                                                        <span class="form-bar"></span>
                                                        <label class="float-label">Date of Birth<span class="text-danger">*</span></label>
                                                        <small class="error-msg"></small>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group form-default focus-date-select">
                                                        <input type="text" name="name" class="form-control">
                                                        <span class="form-bar"></span>
                                                        <label class="float-label">Birth Place</label>
                                                        <small class="error-msg"></small>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group custon-select material-custon-select focus-select">
                                                        <label class="form-label">Gender<span class="text-danger">*</span></label>
                                                        <select class="form-control" required="">
                                                            <option value=""></option>
                                                            <option value="male">Male</option>
                                                            <option value="female">Female</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group custon-select material-custon-select focus-select">
                                                        <label class="form-label">Blood Group</label>
                                                        <select class="form-control">
                                                            <option value=""></option>
                                                            <option value="A+">A+</option>
                                                            <option value="A-">A-</option>
                                                            <option value="B+">B+</option>
                                                            <option value="B-">B-</option>
                                                            <option value="AB+">AB+</option>
                                                            <option value="AB-">AB-</option>
                                                            <option value="O+">O+</option>
                                                            <option value="O-">O-</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group custon-select material-custon-select focus-select">
                                                        <label class="form-label">Marital Status<span class="text-danger">*</span></label>
                                                        <select class="form-control" required="">
                                                            <option value=""></option>
                                                            <option value="single">Single</option>
                                                            <option value="married">Married</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group custon-select material-custon-select focus-select">
                                                        <label class="form-label">Religion<span class="text-danger">*</span></label>
                                                        <select class="form-control" required="">
                                                            <option value=""></option>
                                                            <option value="islam">Islam</option>
                                                            <option value="christianity">Christian</option>
                                                            <option value="hinduism">Hindu</option>
                                                            <option value="buddhism">Buddh</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group custon-select material-custon-select focus-select">
                                                        <label class="form-label">Nationality</label>
                                                        <select class="form-control">
                                                            <option value=""></option>
                                                            <option value="bangladeshi">Bangladeshi</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                 
                                            </div>
                                        </div>
                                        <div class="section-blog-card m-0 m-b-20">
                                            <h6 class="group-title">Employee Required:</h6>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group form-default focus-date-select">
                                                        <input type="text" name="name" class="form-control">
                                                        <span class="form-bar"></span>
                                                        <label class="float-label">National Id<span class="text-danger">*</span></label>
                                                        <small class="error-msg"></small>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group form-default focus-date-select">
                                                        <input type="text" name="name" class="form-control">
                                                        <span class="form-bar"></span>
                                                        <label class="float-label">Passport No.</label>
                                                        <small class="error-msg"></small>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group form-default focus-date-select">
                                                        <input type="text" name="name" class="form-control">
                                                        <span class="form-bar"></span>
                                                        <label class="float-label">Driving License</label>
                                                        <small class="error-msg"></small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="section-blog-card m-0 m-b-20">
                                            <h6 class="group-title">Employee Official Info:</h6>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group form-default focus-date-select">
                                                        <input type="text" name="name" class="form-control">
                                                        <span class="form-bar"></span>
                                                        <label class="float-label">Employee Id<span class="text-danger">*</span></label>
                                                        <small class="error-msg"></small>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group custon-select material-custon-select focus-select">
                                                        <label class="form-label">Employee Type<span class="text-danger">*</span></label>
                                                        <select class="form-control" required="">
                                                            <option value=""></option>
                                                            <option value="doctor">Doctor</option>
                                                            <option value="nurse">Nurse</option>
                                                            <option value="pharmacist">Pharmacist</option>
                                                            <option value="technician">Medical Technician</option>
                                                            <option value="therapist">Therapist</option>
                                                            <option value="paramedic">Paramedic</option>
                                                            <option value="administrator">Administrator</option>
                                                            <option value="receptionist">Receptionist</option>
                                                            <option value="laboratory_staff">Laboratory Staff</option>
                                                            <option value="radiologist">Radiologist</option>
                                                            <option value="dietitian">Dietitian</option>
                                                            <option value="surgeon">Surgeon</option>
                                                            <option value="physician">Physician</option>
                                                            <option value="dentist">Dentist</option>
                                                            <option value="psychiatrist">Psychiatrist</option>
                                                            <option value="optometrist">Optometrist</option>
                                                            <option value="emergency_staff">Emergency Staff</option>
                                                            <option value="other">Other</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group custon-select material-custon-select focus-select">
                                                        <label class="form-label">Job Nature<span class="text-danger">*</span></label>
                                                        <select class="form-control" required="">
                                                            <option value=""></option>
                                                            <option value="full_time">Full-Time</option>
                                                            <option value="part_time">Part-Time</option>
                                                            <option value="contract">Contract</option>
                                                            <option value="freelance">Freelance</option>
                                                            <option value="internship">Internship</option>
                                                            <option value="temporary">Temporary</option>
                                                            <option value="permanent">Permanent</option>
                                                            <option value="volunteer">Volunteer</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group custon-select material-custon-select focus-select">
                                                        <label class="form-label">Department<span class="text-danger">*</span></label>
                                                        <select class="form-control" required="">
                                                            <option value=""></option>
                                                            <option value="general_medicine">General Medicine</option>
                                                            <option value="cardiology">Cardiology</option>
                                                            <option value="neurology">Neurology</option>
                                                            <option value="orthopedics">Orthopedics</option>
                                                            <option value="pediatrics">Pediatrics</option>
                                                            <option value="gynecology">Gynecology</option>
                                                            <option value="dermatology">Dermatology</option>
                                                            <option value="oncology">Oncology</option>
                                                            <option value="radiology">Radiology</option>
                                                            <option value="urology">Urology</option>
                                                            <option value="psychiatry">Psychiatry</option>
                                                            <option value="ophthalmology">Ophthalmology</option>
                                                            <option value="otolaryngology">Otolaryngology (ENT)</option>
                                                            <option value="anesthesiology">Anesthesiology</option>
                                                            <option value="emergency_medicine">Emergency Medicine</option>
                                                            <option value="pathology">Pathology</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group custon-select material-custon-select focus-select">
                                                        <label class="form-label">Designation<span class="text-danger">*</span></label>
                                                        <select class="form-control" required="">
                                                            <option value=""></option>
                                                            <option value="doctor">Doctor</option>
                                                            <option value="nurse">Nurse</option>
                                                            <option value="pharmacist">Pharmacist</option>
                                                            <option value="therapist">Therapist</option>
                                                            <option value="administrator">Administrator</option>
                                                            <option value="technician">Technician</option>
                                                            <option value="assistant">Assistant</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group custon-select material-custon-select focus-select">
                                                        <label class="form-label">Employee Grade<span class="text-danger">*</span></label>
                                                        <select class="form-control" required="">
                                                            <option value=""></option>
                                                            <option value="gradea">Grade A</option>
                                                            <option value="gradeb">Grade B</option>
                                                            <option value="gradec">Grade C</option>
                                                            <option value="graded">Grade D</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group form-default focus-date-select">
                                                        <input id="datepicker2" type="text" name="name" class="form-control" required>
                                                        <span class="form-bar"></span>
                                                        <label class="float-label">Joining Date<span class="text-danger">*</span></label>
                                                        <small class="error-msg"></small>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group form-default focus-date-select">
                                                        <input id="datepicker3" type="text" name="name" class="form-control" required>
                                                        <span class="form-bar"></span>
                                                        <label class="float-label">Confirmation Date<span class="text-danger">*</span></label>
                                                        <small class="error-msg"></small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="section-blog-card m-0 m-b-20">
                                            <h6 class="group-title">Other:</h6>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group form-default focus-date-select">
                                                        <input type="text" name="name" class="form-control">
                                                        <span class="form-bar"></span>
                                                        <label class="float-label">Qualification (If Doctor)</label>
                                                        <small class="error-msg"></small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="section-blog-card m-0">
                                            <h6 class="group-title">N/A:</h6>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group custon-select material-custon-select focus-select">
                                                        <label class="form-label">Status<span class="text-danger">*</span></label>
                                                        <select class="form-control" required="">
                                                            <option value=""></option>
                                                            <option value="gradea">Active</option>
                                                            <option value="gradeb">Inactive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-2 p-0">
                                            <div class="form-group mt-3">
                                                <button type="submit" class="custom-btn btn btn-primary btn-md btn-block waves-effect waves-light text-center">Save & Next</button>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="tab-pane" id="ContactInfo" role="tabpanel">
                                        2
                                    </div>
                                    <div class="tab-pane" id="FamilyInfo" role="tabpanel">
                                        3
                                    </div>
                                    <div class="tab-pane" id="CurriculumInfo" role="tabpanel">
                                        4
                                    </div>
                                    <div class="tab-pane" id="ImportantDocument" role="tabpanel">
                                        5
                                    </div>
                                    <div class="tab-pane" id="BankInfo" role="tabpanel">
                                        6
                                    </div>
                                </div>
                            </form>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

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
    });
    $(document).ready(function(){
        $('ul.md-tabs li:first-child a').addClass('active');
    });
</script>
<script>
    $(document).ready(function() {
        // Initialize the datepicker
            $('#datepicker, #datepicker2, #datepicker3').datepicker({
            format: 'mm/dd/yyyy', // Date format
            autoclose: true,      // Automatically close the datepicker after selecting a date
            todayHighlight: true,  // Highlight today's date
        });
    });

    $(document).ready(function() {
        $('#EmployeeCreate').attr('autocomplete', 'off');
        $('#EmployeeCreate input').attr('autocomplete', 'off');
    });
    
</script>

<script>
    $(document).ready(function () {
        // Add 'focus-date-select' class when date input gains focus
        $('.focus-date-select input').on('focus', function () {
            $(this).closest('.form-group').addClass('focused');
        });

        // Remove 'focused' class on blur if no value is set
        $('.focus-date-select input').on('blur', function () {
            if (!$(this).val()) {
                $(this).closest('.form-group').removeClass('focused');
            }
        });

        // Add 'focus-date-select' class when a date is selected
        $('.focus-date-select input').on('change', function () {
            if ($(this).val()) {
                $(this).closest('.form-group').addClass('has-value');
            } else {
                $(this).closest('.form-group').removeClass('has-value');
            }
        });
    });

</script>
<script>
    $(document).ready(function () {
        $('.focus-select select').on('focus', function () {
            $(this).closest('.form-group').addClass('focused');
        });

        $('.focus-select select').on('blur', function () {
            // Remove focus class on blur if no option is selected
            if (!$(this).val()) {
                $(this).closest('.form-group').removeClass('focused');
            }
        });

        $('.focus-select select').on('change', function () {
            // Add class if there's a selected value
            if ($(this).val()) {
                $(this).closest('.form-group').addClass('has-value');
            } else {
                $(this).closest('.form-group').removeClass('has-value');
            }
        });
    });
</script>



@endpush