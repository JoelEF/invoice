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
                    <h4 class="page-title">Add New Customer</h4>

                </div>
            </div>


            <div class="row ">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body set-padding">

                            <div class="row">
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal1"><i class="fa fa-plus"> </i> Create Customer</button>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 " style="margin-top: 25px !important;">
                                    @if(session()->has('message'))
                                        <span class="alert alert-success">
                                                        <strong>{{session()->get('message')}}</strong>
                                                    </span>
                                    @endif

                                </div>
                            </div>

                            <div class="modal fade" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                                <div class="modal-dialog" role="document ">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Create Customer</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true ">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="form-horizontal" method="post" id="add-customer-form" action="{{route('add-customer')}}">

                                                {{csrf_field()}}

                                                <div class="form-group row">
                                                    <label for="c_name" class="col-sm-3 text-center control-label col-form-label">Name</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" id="name" name="name"  required>
                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <label for="c_address" class="col-sm-3 text-center control-label col-form-label">Address</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" id="address" name="address" required>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="c_address" class="col-sm-3 text-center control-label col-form-label">Country</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" id="country" name="country" required>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="c_zip" class="col-sm-3 text-center control-label col-form-label">Zip</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" id="zip" name="zip" required>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="c_btw" class="col-sm-3 text-center control-label col-form-label">BTWNummer</label>
                                                    <div class="col-sm-6">
                                                        <input type="number" class="form-control" id="btw" name="btw" value="0">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="c_cnic" class="col-sm-3 text-center control-label col-form-label">KVK</label>
                                                    <div class="col-sm-6">
                                                        <input type="number" class="form-control" id="kvk" name="kvk" value="0">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="c_phone" class="col-sm-3 text-center control-label col-form-label">Phone</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control phone-inputmask" id="phone" name="phone" value="0">
                                                    </div>
                                                </div>




                                                <div class="border-top">
                                                    <div class="card-body text-center">
                                                        <button type="submit" class="btn btn-success">Submit</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal -->




                            <div class="table-responsive mt-4">
                                <table id="zero_config" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Kvk</th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($customers as $customer)
                                        <tr>
                                            <td>{{$customer['name']}}</td>
                                            <td>{{$customer['phone']}}</td>
                                            <td>{{$customer['address']}}</td>
                                            <td>{{$customer['kvk']}}</td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Kvk</th>
                                    </tr>
                                    </tfoot>
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
