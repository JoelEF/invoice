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
                                <form id="invoiceform" method="post"  action="{{ route('invoice.update', $invoice->id) }}" class="form-horizontal mt-3" >
                                    @method('PATCH')
                                    @csrf
                                    <div class="card-body text-center">
                                        <h4 class="card-title">{{__('message.invoice')}}</h4>
                                        <div class="form-group row mt-4">
                                            <label for="serial" class="col-sm-2 text-center control-label col-form-label">{{__('message.invoice_no')}} :</label>
                                            <div class="col-sm-3">
                                               
                                                <input type="number" class="form-control"  value="{{$invoice->invoice_number}}" id="invoice_no" name="invoice_no" >
                                                 
                                            </div>

                                            <label for="serial" class="col-sm-2 text-center control-label col-form-label">{{__('message.invoice_date')}} <small class="text-muted">dd/mm/yyyy</small></label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control date-inputmask mydatepicker" id="invoice_start_date" name="invoice_start_date" value="{{$invoice->invoice_date}}" autocomplete="off">
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
                                                    

                                                        <option value="{{$customer['id']}}">{{$customer['name']}}</option>

                                                    




                                                </select>
                                            </div>

                                            <label for="serial" class="col-sm-2 text-center control-label col-form-label mydatepicker">{{__('message.expiry_date')}} <small class="text-muted">dd/mm/yyyy</small></label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control date-inputmask mydatepicker" id="invoice_expiry_date" name="invoice_expiry_date" value="{{$invoice->expiry_date}}">
                                            </div>

                                        </div>



                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dynamic_field">
                                                <thead>
                                                <tr>

                                                    <th>{{__('message.service_date')}}</th>
                                                    <th>{{__('message.place_of_work')}}</th>
                                                    <th>Pauze</th>
                                                    <th>{{__('message.start_time')}}</th>
                                                    <th>{{__('message.end_time')}}</th>

                                                    <th>Total</th>
                                                    <th>{{__('message.p_hr')}}</th>
                                                    <th>{{__('message.total')}} </th>

                                                    <th>Action</th>

                                                </tr>
                                                </thead>
                                                
        @foreach($invoicechildd as $invoicechild )
<!--
        <tr>
            <td><input type="text" value="{{$invoicechild->place_of_work}}" > <br>Uren {{$invoicechild->start_time}} - {{$invoicechild->end_time}}<br>{{date('d-m-yy', strtotime($invoicechild->service_date))}}</td>

            <td>{{$invoicechild->wh}}</td>
            <td>{{str_replace('.',',', $invoicechild->price_per_hour)}}</td>
            <td align="left">€ {{str_replace('.',',',$invoicechild->total)}}</td>
        </tr>
-->
           
                                                <tbody><tr>

                                                    <td style="width: 15.333%;"> <div class="col-md-12">
                                                            <input type="text"  name=service_Date[] class="form-control  " id="service_Date" value="{{$invoicechild->service_date}}">
                                                        </div>
                                                    </td>
                                                            

                                                    <td style="width: 15.333%;"> <div class="col-md-12">
                                                            <input type="text"  name=pol[] style="width: 300px;" class="form-control pol" id="pol" value="{{$invoicechild->place_of_work}}" required>
                                                        </div>
                                                    </td>


                                                    <td style="width: 15.333%;">  <div class="col-md-12">
                                                            <input type="text"   name=break[] class="form-control break" id="break"  value="{{$invoicechild->break}}" required >
                                                        </div>
                                                    </td>

                                                    <td style="width: 15.333%;">  <div class="col-md-12">
                                                            <input type="text"  name=st[] class="form-control st" id="st" value="{{$invoicechild->start_time}}" required>
                                                        </div>
                                                    </td>



                                                    <td style="width: 15.333%;">  <div class="col-md-12">
                                                            <input type="text"   name=et[] class="form-control et" id="et" value="{{$invoicechild->end_time}}" required>
                                                        </div>
                                                    </td>




                                                    <td style="width: 15.333%;">
                                                        <div class="col-md-12">
                                                            <input type="text" name="wh[]"  class="form-control wh" id="wh" value="{{$invoicechild->wh}}" required />
                                                        </div>
                                                    </td>

                                                    <input id="diff" type="hidden">

<!--                                                     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
<!-- {{--                                                    value--}} -->
<!-- {{--                                                    <input type="text" name="gvalue" id="input" class="input" required/>Percentage--}} -->
<!-- {{--                                                    <select name="percent" id="percent" class="input">--}} -->
<!-- {{--                                                        <option value="Country" selected>Select Percentage</option>--}} -->
<!-- {{--                                                        <option value="5">5</option>--}} -->
<!-- {{--                                                        <option value="10">10</option>--}} -->
<!-- {{--                                                        <option value="15">15</option>--}} -->
<!-- {{--                                                    </select>--}} -->

<!-- {{--                                                    Final Value--}} -->


                                                    <td style="width: 15.333%;">  <div class="col-md-12">
                                                            <input type="number"  name=pph[] class="form-control pph" id="pph" value="{{$invoicechild->price_per_hour}}" required>
                                                        </div>
                                                    </td>
                                                    <td style="width: 55.333%;">  <div class="col-md-12">
                                                            <input type="text" name=tp[] class="form-control tp" id="tp" style="width: 100px;" value="{{$invoicechild->total}}" required>
                                                        </div>
                                                    </td>








                                                    <td><i id="removee" class="fa fa-trash"></i></td>
                                                </tr></tbody>
                                                 @endforeach
                              
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
                                                    <input type="text" class="subtot form-control" name="subtot" value="{{$invoice->sub_total}}"/>
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
                                                    <input type="text" class="invoice_price form-control "  id="invoice_price" name="invoice_price" value="{{$invoice->total}}" required>
                                      
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="border-top">
                                        <div class="card-body text-center">
                                            <button id="invoicesubmit" type="submit" class="btn btn-success">Edit</button>
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
