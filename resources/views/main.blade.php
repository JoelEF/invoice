@extends('home')

@section('main')
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Dashboard</h4>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Sales Cards  -->
            <!-- ============================================================== -->
            <div class="row">
                <!-- Column -->
                <div class="col-md-6 col-lg-2 col-xlg-3">
                    <div class="card card-hover">
                        <a href="{{url('/')}}">
                            <div class="box bg-cyan text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i></h1>
                                <h6 class="text-white">Dashboard</h6>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- Column -->
                <div class="col-md-6 col-lg-4 col-xlg-3">
                    <div class="card card-hover">
                        <a href="{{route('create-invoice')}}">
                        <div class="box bg-success text-center">
                            <h1 class="font-light text-white"><i class="mdi mdi-chart-areaspline"></i></h1>
                            <h6 class="text-white">Invoices</h6>
                        </div>
                        </a>
                    </div>
                </div>
                <!-- Column -->
                <div class="col-md-6 col-lg-2 col-xlg-3">
                    <div class="card card-hover">
                        <a href="{{route('view-customers')}}">
                            <div class="box bg-warning text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-account"></i></h1>
                                <h6 class="text-white">Customers</h6>

                            </div>
                        </a>
                    </div>
                </div>
                <!-- Column -->
                <div class="col-md-6 col-lg-2 col-xlg-3">
                    <div class="card card-hover">
                        <a href="{{url('/')}}">
                            <div class="box bg-danger text-center">
                                <h1 class="font-light text-white"><i class="mdi mdi-settings"></i></h1>
                                <h6 class="text-white">Account Setting</h6>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- Column -->
                <div class="col-md-6 col-lg-2 col-xlg-3">
                    <div class="card card-hover">
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <div class="box bg-info text-center" >
                                <h1 class="font-light text-white"><i class="mdi mdi-logout"></i></h1>
                                <h6 class="text-white">Logout</h6>
                            </div>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
                <!-- Column -->

            </div>

        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>


    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
@endsection
