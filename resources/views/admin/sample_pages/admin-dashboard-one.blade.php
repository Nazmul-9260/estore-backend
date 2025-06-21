@extends('layouts.master')

@section('content')

<div class="page-body">

    <div class="row">
        <div class="col-xl-12">
            <div class="proj-progress-card">
                <div class="row">
                    <div class="col-md-2">
                        <div class="quick-link-item">
                            <a href="#">
                                <div class="card qiick-link-icon"><img src="assets/images/quick-img1.png" alt=""></div>
                                <span>New Registration</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="quick-link-item">
                            <a href="#">
                                <div class="card qiick-link-icon"><img src="assets/images/quick-img2.png" alt=""></div>
                                <span>New Serial</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="quick-link-item">
                            <a href="#">
                                <div class="card qiick-link-icon"><img src="assets/images/quick-img3.png" alt=""></div>
                                <span>Emergency Ticket</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="quick-link-item">
                            <a href="#">
                                <div class="card qiick-link-icon"><img src="assets/images/quick-link5.png" alt=""></div>
                                <span>Ward Patients Reg</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="quick-link-item">
                            <a href="#">
                                <div class="card qiick-link-icon"><img src="assets/images/quick-link4.png" alt=""></div>
                                <span>Cabin</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="quick-link-item">
                            <a href="#">
                                <div class="card qiick-link-icon"><img src="assets/images/quick-img6.png" alt=""></div>
                                <span>Operations</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="row proj-progress-info">
                <!-- sale card start -->

                <div class="col-md-3">
                    <div class="card text-center order-visitor-card bg1">
                        <div class="card-block">
                            <h6 class="m-b-0">Total Admitted Patients</h6>
                            <h4 class="m-t-15 m-b-15"><i class="fa fa-wheelchair-alt m-r-15 text-c-red"></i>300</h4>
                            <p class="m-b-0 text-right"><a href="#">View Details <i class="fa fa-angle-double-right"></i></a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center order-visitor-card bg2">
                        <div class="card-block">
                            <h6 class="m-b-0">Total Discharge Avg</h6>
                            <h4 class="m-t-15 m-b-15"><i class="fa fa-wheelchair m-r-15 text-c-green"></i>60</h4>
                            <p class="m-b-0 text-right"><a href="#">View Details <i class="fa fa-angle-double-right"></i></a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center order-visitor-card bg3">
                        <div class="card-block">
                            <h6 class="m-b-0">Total Diagnosis Done</h6>
                            <h4 class="m-t-15 m-b-15"><i class="fa fa-medkit m-r-15 text-c-green"></i>400</h4>
                            <p class="m-b-0 text-right"><a href="#">View Details <i class="fa fa-angle-double-right"></i></a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center order-visitor-card bg4">
                        <div class="card-block">
                            <h6 class="m-b-0">Total Bed Occupied</h6>
                            <h4 class="m-t-15 m-b-15"><i class="fa fa-bed m-r-15 text-c-green"></i>67</h4>
                            <p class="m-b-0 text-right"><a href="#">View Details <i class="fa fa-angle-double-right"></i></a></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card text-center order-visitor-card bg2">
                        <div class="card-block">
                            <h6 class="m-b-0">Total Cabin Occupied</h6>
                            <h4 class="m-t-15 m-b-15"><i class="fa fa-bed m-r-15 text-c-red"></i>300</h4>
                            <p class="m-b-0 text-right"><a href="#">View Details <i class="fa fa-angle-double-right"></i></a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center order-visitor-card bg3">
                        <div class="card-block">
                            <h6 class="m-b-0"> Patient In ICU</h6>
                            <h4 class="m-t-15 m-b-15"><i class="fa fa-h-square m-r-15 text-c-red"></i>60</h4>
                            <p class="m-b-0 text-right"><a href="#">View Details <i class="fa fa-angle-double-right"></i></a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center order-visitor-card bg1">
                        <div class="card-block">
                            <h6 class="m-b-0">Total Outdoor Patients</h6>
                            <h4 class="m-t-15 m-b-15"><i class="fa fa-wheelchair-alt m-r-15 text-c-red"></i>400</h4>
                            <p class="m-b-0 text-right"><a href="#">View Details <i class="fa fa-angle-double-right"></i></a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center order-visitor-card bg2">
                        <div class="card-block">
                            <h6 class="m-b-0">Total Readmitted</h6>
                            <h4 class="m-t-15 m-b-15"><i class="fa fa-ambulance m-r-15 text-c-red"></i>67</h4>
                            <p class="m-b-0 text-right"><a href="#">View Details <i class="fa fa-angle-double-right"></i></a></p>
                        </div>
                    </div>
                </div>


                <!-- sale card end -->
            </div>
        </div>

    </div>
</div>


<style>
    .pcoded-main-container {
        min-height: calc(100vh - 108px);
    }
</style>
@endsection

@push('scripts')

<script src="{{asset('js/morris-custom-chart.js')}}"></script>

@endpush