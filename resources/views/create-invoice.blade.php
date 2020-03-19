@extends('home')

@section('main')

    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Maak een nieuwe factuur</h4>

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

                <div class="col-md-12">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <form id="invoiceform" method="post"  action="{{url('submit/invoice')}}" class="form-horizontal mt-3" >

                                    {{csrf_field()}}
                                    <div class="card-body text-center">
                                        <h4 class="card-title">{{__('message.invoice')}}</h4>
                                        <div class="form-group row mt-4">
                                            <label for="serial" class="col-sm-2 text-center control-label col-form-label">{{__('message.invoice_no')}} :</label>
                                            <div class="col-sm-3">
                                                <input type="number" class="form-control"  value="{{$invoiceno}}" id="invoice_no" name="invoice_no" readonly>
                                            </div>

                                            <label for="serial" class="col-sm-2 text-center control-label col-form-label">{{__('message.invoice_date')}} <small class="text-muted">dd/mm/yyyy</small></label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control date-inputmask mydatepicker" id="invoice_start_date" name="invoice_start_date" placeholder="Voeg de datum toe">
                                            </div>

                                        </div>

                                        <label for="serial" class="col-sm-2 text-center control-label col-form-label">Kies aantal dagen tot betaling</label>
                                        <div class="col-sm-12">
                                            <select id="cars" name="cars" onclick="getdate()" required >
                                                <option value="30">30</option>
                                            </select>

                                            <!-- <input type="button" onclick="getdate()" value="Fill Follow Date" /> -->
                                        </div>



                                        <div class="form-group row">
                                            <label for="vendor" class="col-sm-2 text-center control-label col-form-label">{{__('message.customer')}}:</label>
                                            <div class="col-sm-3">
                                                <select class="select2 form-control custom-select" name="customer_name" style="width: 100%; height:36px;">
                                                    @foreach($customer as $customers)

                                                        <option value="{{$customers['id']}}">{{$customers['name']}}</option>

                                                    @endforeach




                                                </select>
                                            </div>

                                            <label for="serial" class="col-sm-2 text-center control-label col-form-label mydatepicker">{{__('message.expiry_date')}} <small class="text-muted">dd/mm/yyyy</small></label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control date-inputmask mydatepicker" id="invoice_expiry_date" name="invoice_expiry_date" placeholder=" {{__('message.expiry_date')}}">
                                            </div>

                                        </div>



                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dynamic_field">
                                                <thead>
                                                <tr>

                                                    <th>{{__('message.service_date')}}</th>
                                                    <th>{{__('message.place_of_work')}}</th>
                                                    <th>{{__('message.start_time')}}</th>
                                                    <th>{{__('message.end_time')}}</th>
                                                    <th>Pauze</th>
                                                    <th>{{__('message.p_hr')}}</th>
                                                    <th>{{__('message.total')}} </th>

                                                    <th>Action</th>

                                                </tr>
                                                </thead>
                                                <tbody><tr>

                                                    <td style="width: 15.333%;"> <div class="col-md-12">
                                                            <input type="date"  name=service_Date[] class="form-control " id="service_Date" placeholder="dd/mm/yyyy" required>
                                                        </div>
                                                    </td>


                                                    <td style="width: 15.333%;"> <div class="col-md-12">
                                                            <input type="text"  name=pol[] class="form-control pol" id="pol" required>
                                                        </div>
                                                    </td>

                                                    <td style="width: 15.333%;">  <div class="col-md-12">
                                                            <input type="text"  name=st[] class="form-control st" id="st" required>
                                                        </div>
                                                    </td>



                                                    <td style="width: 15.333%;">  <div class="col-md-12">
                                                            <input type="text"   name=et[] class="form-control et" id="et" required>
                                                        </div>
                                                    </td>


                                                    <td style="width: 15.333%;">  <div class="col-md-12">
                                                            <input type="text"   name=break[] class="form-control break" id="break" required>
                                                        </div>
                                                    </td>

                                                    <input id="diff" hidden>



                                                    <td style="width: 15.333%;">  <div class="col-md-12">
                                                            <input type="number"  name=pph[] class="form-control pph" id="pph" required>
                                                        </div>
                                                    </td>
                                                    <td style="width: 55.333%;">  <div class="col-md-12">
                                                            <input type="text" name=tp[] class="form-control tp" id="tp" style="width: 100px;" required>
                                                        </div>
                                                    </td>








                                                    <td><i id="removee" class="fa fa-trash"></i></td>
                                                </tr></tbody>
                                            </table>

                                        </div>


                                        <div class="row" style="text-align: initial;">
                                            <div class="col-md-2">
                                                <button id="add" type="button" class="btn btn-primary" ><i class="fa fa-plus"> </i> {{__('message.add_more')}}</button>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-12">
                                        <div class="pull-right m-t-30 text-right">

                                            <hr>



                                            <div class="form-group row pull-right text-right">
                                                <label for="subtot" class="col-sm-2 text-center control-label col-form-label"><b>Sub Total :</b></label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="subtot form-control" value="0" name="subtot" readonly/>
                                                </div>
                                            </div>

                                                                                    <div class="form-group row pull-right text-right">
                                                                                        <label for="invoice_tax" class="col-sm-2 text-center control-label col-form-label"><b>{{__('message.tax')}} % :</b></label>
                                                                                        <div class="col-sm-3">
                                                                                            <input type="text" class="invoice_tax form-control "  id="invoice_tax" name="invoice_tax" value="21" required>
                                                                                            @if($errors->has('invoice_tax'))
                                                                                                <span class="invalid-feedback-custom" role="alert">
                                                                                                    <strong>{{$errors->first('invoice_tax')}}</strong>
                                                                                                </span>
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>


                                            <div class="form-group row pull-right text-right">
                                                 <div class="col-sm-3">
                                                     <input type="number" class="invoice_tax_price form-control " hidden="hidden" id="invoice_tax_price" name="invoice_tax_price" >

                                                 </div>
                                            </div>

                                            <div class="form-group row pull-right text-right">
                                                <label for="invoice_price" class="col-sm-2 text-center control-label col-form-label"><b>Total :</b></label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="invoice_price form-control "  id="invoice_price" name="invoice_price" required>
                                                    @if($errors->has('invoice_price'))
                                                        <span class="invalid-feedback-custom" role="alert">
                                                                                                    <strong>{{$errors->first('invoice_price')}}</strong>
                                                                                                </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="border-top">
                                        <div class="card-body text-center">
                                            <button id="invoicesubmit" type="submit" class="btn btn-success">Submit</button>
                                        </div>
                                    </div>
                                </form>
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
