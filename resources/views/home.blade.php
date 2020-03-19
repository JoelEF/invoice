@extends('layouts.app')

@section('content')
    <main class="">
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>



        <div id="main-wrapper">

            <!-- ============================================================== -->
            <!-- Left Sidebar - style you can find in sidebar.scss  -->
            <!-- ============================================================== -->

                <aside class="left-sidebar" data-sidebarbg="skin5">
                    <!-- Sidebar scroll-->
                    <div class="scroll-sidebar">
                        <!-- Sidebar navigation-->
                        <nav class="sidebar-nav">
                            <ul id="sidebarnav" class="p-t-30">

                                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{url('/')}}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('view-customers')}}" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">Customers</span></a></li>
                                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('create-invoice')}}" aria-expanded="false"><i class="mdi mdi-file"></i><span class="hide-menu">Create Invoices</span></a></li>
                                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('view-pending-invoices')}}" aria-expanded="false"><i class="mdi mdi-file-check"></i><span class="hide-menu">Pending Invoices</span></a></li>
                                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('view-approved-invoices')}}" aria-expanded="false"><i class="mdi mdi-file-document-box"></i><span class="hide-menu">Approved Invoices</span></a></li>


                            </ul>
                        </nav>
                        <!-- End Sidebar navigation -->
                    </div>
                    <!-- End Sidebar scroll-->
                </aside>

            <!-- ============================================================== -->
            <!-- End Left Sidebar - style you can find in sidebar.scss  -->
            <!-- ============================================================== -->
            @yield('main')
        </div>





    </main>
@endsection
