@extends('home')

@section('main')

    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">

        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Pending Invoices</h4>

                </div>
            </div>




            <div class="row ">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-4 " style="margin-top: 25px !important;">
                                    @if(session()->has('message'))
                                        <span class="alert alert-success">
                                                        <strong>{{session()->get('message')}}</strong>
                                                    </span>
                                    @endif

                                </div>
                            </div>


                            <div class="table-responsive mt-4">
                                <table id="zero_config" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Invoice no</th>
                                        <th>Customer</th>
                                        <th>Invoice Date</th>
                                        <th>Expiry Date</th>
                                        <th>Total Price</th>

                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @if((!$invoice)):

                                    <div class="container">
                                        <div class="row">
                                            <div class="text-center">
                                                <h4>No Invoices</h4>
                                            </div>
                                        </div>
                                    </div>


                                    @else

                                        @foreach($invoice as $invoices)
                                            <tr>
                                                <td>{{$invoices->invoice_number}}</td>
                                                <td>{{$invoices->userName}}</td>
                                                <td>{{$invoices->invoice_date}}</td>
                                                <td>{{$invoices->expiry_date}}</td>
                                                <td>{{$invoices->total}}</td>

                                                <td><div class="row">
                                                        <div class="col-md-6">

                                                            <a class="btn btn-warning btn-sm" href="{{route('approve.invoice',$invoices->id )}}" data-toggle="tooltip" data-placement="top" title="Paid">
                                                                Mark Paid
                                                            </a>
                                                        </div>

                                                        <div class="col-md-6">

                                                            <a class="btn btn-danger btn-sm" href="{{url('generate-pdf/'.$invoices->id)}}" data-toggle="tooltip" data-placement="top" title="Print">
                                                                Print
                                                            </a>
                                                        </div>


                                                    </div></td>

                                            </tr>


                                        @endforeach

                                    @endif
                                    </tbody>
{{--                                    <tfoot>--}}
{{--                                    <tr>--}}
{{--                                        <th>Invoice no</th>--}}
{{--                                        <th>Customer</th>--}}
{{--                                        <th>Invoice Date</th>--}}
{{--                                        <th>Expiry Date</th>--}}
{{--                                        <th>Total Price</th>--}}
{{--                                        <th>Action</th>--}}
{{--                                    </tr>--}}
{{--                                    </tfoot>--}}
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->



    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
    @endsection
