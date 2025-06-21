@extends('layouts.master')

@section('content')

<div class="page-body">
       <!-- START ROW -->
       <div class="row">
        <div class="col-md-12 col-lg-6">
            <div class="row proj-progress-info proj-progress-info2">
                <div class="col-md-6">
                    <div class="card text-center order-visitor-card bg1">
                        <div class="card-block">
                            <h6 class="m-b-0">Total Order</h6>
                            <h4 class="m-t-15 m-b-15"><i class="fa fa-shopping-cart" aria-hidden="true"></i>300</h4>
                            <p class="m-b-0 text-right"><a href="#">View Details <i class="fa fa-angle-double-right"></i></a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card text-center order-visitor-card bg2">
                        <div class="card-block">
                            <h6 class="m-b-0">Total Delivery</h6>
                            <h4 class="m-t-15 m-b-15"><i class="fa fa-shopping-cart" aria-hidden="true"></i>60</h4>
                            <p class="m-b-0 text-right"><a href="#">View Details <i class="fa fa-angle-double-right"></i></a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card text-center order-visitor-card bg3">
                        <div class="card-block">
                            <h6 class="m-b-0">Today Order</h6>
                            <h4 class="m-t-15 m-b-15"><i class="fa fa-shopping-cart" aria-hidden="true"></i>400</h4>
                            <p class="m-b-0 text-right"><a href="#">View Details <i class="fa fa-angle-double-right"></i></a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card text-center order-visitor-card bg4">
                        <div class="card-block">
                            <h6 class="m-b-0">Today Delivery</h6>
                            <h4 class="m-t-15 m-b-15"><i class="fa fa-shopping-cart" aria-hidden="true"></i>67</h4>
                            <p class="m-b-0 text-right"><a href="#">View Details <i class="fa fa-angle-double-right"></i></a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card text-center order-visitor-card bg1">
                        <div class="card-block">
                            <h6 class="m-b-0">Today Confirm Order</h6>
                            <h4 class="m-t-15 m-b-15"><i class="fa fa-shopping-cart" aria-hidden="true"></i>400</h4>
                            <p class="m-b-0 text-right"><a href="#">View Details <i class="fa fa-angle-double-right"></i></a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card text-center order-visitor-card bg2">
                        <div class="card-block">
                            <h6 class="m-b-0">Today Pending Delivery</h6>
                            <h4 class="m-t-15 m-b-15"><i class="fa fa-shopping-cart" aria-hidden="true"></i>67</h4>
                            <p class="m-b-0 text-right"><a href="#">View Details <i class="fa fa-angle-double-right"></i></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5>Total Sales</h5>
                </div>
                <div class="card-block">
                    <div id="morris-bar-chart"></div>
                </div>
            </div>
        </div>

    </div>
    <!-- END ROW -->

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