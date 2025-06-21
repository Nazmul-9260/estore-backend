@extends('layouts.master-patient')

@section('content')

<div class="page-body custom-main-body">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Patient Profile</h5>
                </div>

                <div class="card-block table-border-style">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="nav-tab-and-button d-flex flex-nowrap justify-content-between">
                                <div class="sub-title-item d-flex flex-nowrap align-items-center">
                                    <h6>With Selected</h6>
                                    <div class="selected-items d-flex flex-nowrap">
                                        <a href="#" class="btn btn-primary custom-btn"><i class="fa fa-pencil"></i> Edit</a>
                                        <a href="#" class="btn btn-primary custom-btn"><i class="fa fa-pencil"></i> Delete</a>
                                    </div>
                                </div>
                                <div class="selected-items d-flex flex-nowrap align-items-start">
                                    <a href="#" class="btn btn-primary custom-btn"><i class="fa fa-plus"></i> Book a Test</a>
                                    <a href="#" class="btn btn-primary custom-btn"><i class="fa fa-plus"></i> Book an Appointment</a>
                                </div>
                            </div>

                            <!-- Nav tabs -->
                            
                            <ul id="tabs-nav" class="nav nav-tabs tabs d-flex flex-wrap tab-custon-menu" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#activity">Current Activity</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#history">Patient History</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#payment">All Payment</a>
                                </li>
                                
                            </ul>
                               
                            <!-- Tab panes -->
                            <div class="tabs card-block p-0 pt-3 patient-tab">
                                <div class="tab-pane tab-content active" id="activity">
                                    <div class="table-user-list custom-table">
                                        <div class="table-responsive">
                                            <table class="table m-0">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <div class="checkbox-fade fade-in-primary">
                                                                <label>
                                                                    <input id="selectAll" type="checkbox" value="">
                                                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                                </label>
                                                            </div>
                                                        </th>
                                                        <th>ID</th>
                                                        <th>Activity Name</th>
                                                        <th>Details</th>
                                                        <th>Date/Time</th>
                                                        <th>Status</th>
                                                        <th>Print</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="checkbox-fade fade-in-primary">
                                                                <label>
                                                                    <input type="checkbox" value="">
                                                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                                </label>
                                                            </div>
                                                        </th>
                                                        <td>1</td>
                                                        <td>Doctor Appointment</td>
                                                        <td>
                                                            <p><strong>Consultant Name:</strong> Dr. Abdur Rahiman</p> 
                                                            <p><strong>Serial:</strong> 26</p>
                                                            <p><strong>Branch:</strong> Dhanmondi</p>
                                                            <p><strong>Address:</strong> House #16, Road # 2, Dhanmondi R/A, Dhaka-1205, Bangladesh</p>
                                                        </td>
                                                        <td>Sep 14, 2024<br> 5:01 am</td>
                                                        <td>
                                                            <div class="permission-items">
                                                                <span class="btn btn-success">Pending</span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="permission-items">
                                                                <span class="btn btn-primary">Print Token</span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                     <tr>
                                                        <th scope="row">
                                                            <div class="checkbox-fade fade-in-primary">
                                                                <label>
                                                                    <input type="checkbox" value="">
                                                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                                </label>
                                                            </div>
                                                        </th>
                                                        <td>2</td>
                                                        <td>Diagnosis Test</td>
                                                        <td>
                                                            <p><a href="#"><strong>MR No.</strong> DIP-20020402</a></p>
                                                        </td>
                                                        <td>Sep 18, 2024<br> 2:01 pm</td>
                                                        <td>
                                                            <div class="permission-items">
                                                                <span class="btn btn-success">Active</span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="permission-items">
                                                                <span class="btn btn-primary">Print Token</span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div class="table-pagination justify-content-between align-items-center d-flex flex-wrap">
                                                <div class="d-md-flex justify-content-between align-items-center dt-layout-start col-md-auto mr-auto pl-0"><div class="dt-info" aria-live="polite" id="users-list-view-table_info" role="status">Showing 1 to 2 of 2 entries</div></div>
                                                <nav aria-label="Page navigation example">
                                                    <ul class="pagination">
                                                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                                    </ul>
                                                </nav>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane tab-content" id="history">
                                    <div class="table-user-list custom-table">
                                    history
                                    </div>
                                </div>
                                <div class="tab-pane tab-content" id="payment">
                                    <div class="table-user-list custom-table">
                                    payment
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>



</div>



@endsection

@push('scripts')

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



@endpush