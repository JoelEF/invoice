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
                        <h4 class="page-title">Account Setting</h4>

                    </div>
                </div>

                @if(!empty($getuser))

            <div class="row">
                <div class="col-md-12">

                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <form class="form-horizontal" method="post" action="{{route('account-setting-update')}}">

                                    {{csrf_field()}}
                                    <div class="card-body text-center">
                                        <h4 class="card-title">Personal Info</h4>
                                        <div class="form-group row">
                                            <label for="username" class="col-sm-3 text-center control-label col-form-label">Username</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" value="{{$getuser->name}}" id="username" disabled>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="email" class="col-sm-3 text-center control-label col-form-label">Email</label>
                                            <div class="col-sm-6">
                                                <input type="email" class="form-control" id="email" placeholder="" value="{{$getuser->email}}"   disabled>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="old_pass" class="col-sm-3 text-center control-label col-form-label">Current Password</label>
                                            <div class="col-sm-6">
                                                <input type="password" class="form-control" id="old_pass" name="old_pass">

                                                @if($errors->has('old_pass'))
                                                    <span class="invalid-feedback-custom" role="alert">
                                                        <strong>{{$errors->first('old_pass')}}</strong>
                                                    </span>
                                                    @endif
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="new_pass" class="col-sm-3 text-center control-label col-form-label">New Password</label>
                                            <div class="col-sm-6">
                                                <input type="password" class="form-control" id="new_pass" name="new_pass">
                                                @if($errors->has('new_pass'))
                                                    <span class="invalid-feedback-custom" role="alert">
                                                        <strong>{{$errors->first('new_pass')}}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        @if(session()->has('message1'))
                                            <span class="alert alert-success">
                                                        <strong>{{session()->get('message1')}}</strong>
                                                    </span>
                                        @endif
                                        @if(session()->has('message'))
                                            <span class="alert alert-danger">
                                                        <strong>{{session()->get('message')}}</strong>
                                                    </span>
                                        @endif


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
            </div>


                    @endif

            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->



        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->



    @endsection
