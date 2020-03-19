@extends('home')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>

    <script>
        function calcrow() {

            // rows calculation


            $(document).ready(function () {

                function timeStringToFloat(time) {
                    var hoursMinutes = time.split(/[.:]/);
                    var hours = parseInt(hoursMinutes[0], 10);
                    var minutes = hoursMinutes[1] ? parseInt(hoursMinutes[1], 10) : 0;
                    return hours + minutes / 60;
                }


                //$('.st, .et .subtot, .pph .tp').prop('readonly', true);
                var $tblrows = $("#dynamic_field tbody tr");

                // count=1;
                $tblrows.each(function (index) {
                    var $tblrow = $(this);


                    //
                    $tblrow.find('.st2 , .et2  , .pph2 , .invoice_tax2 , .break2').on('change keyup', function () {


                        //alert('ha');

                        var s_time = $tblrow.find(".st2").val();
                        var e_time = $tblrow.find(".et2").val();

                        function diff(s_time, e_time) {
                            s_time = s_time.split(":");
                            e_time = e_time.split(":");
                            var startDate = new Date(0, 0, 0, s_time[0], s_time[1], 0);
                            var endDate = new Date(0, 0, 0, e_time[0], e_time[1], 0);
                            var diff = endDate.getTime() - startDate.getTime();
                            var hours = Math.floor(diff / 1000 / 60 / 60);
                            diff -= hours * 1000 * 60 * 60;
                            var minutes = Math.floor(diff / 1000 / 60);

                            return (hours < 9 ? "0" : "") + hours + ":" + (minutes < 9 ? "0" : "") + minutes;


                        }



                        var total_time=  document.getElementById("diff").value = diff(s_time, e_time);
                        // var total_time2 = s_time-e_time;

                        function timeToDecimal(t) {
                            var arr = t.split(':');
                            var dec = parseInt((arr[1]/6)*10, 10);

                            return parseFloat(parseInt(arr[0], 10) + '.' + (dec<10?'0':'') + dec);
                        }
                        var calculate_time = timeToDecimal(total_time);
                        var pph = $tblrow.find(".pph").val();
                        // var b_qty = $tblrow.find("[name=bw]").val();

                        //break

                        var breakTime = $tblrow.find(".break").val()

                        console.log(calculate_time - breakTime);

                        //row total

                        var row_total= parseFloat(pph)*parseFloat(calculate_time - breakTime);

                        console.log(row_total);

                        $tblrow.find('.tp').val(row_total.toFixed(2));

                        final();

                        if (!isNaN(row_total)) {

                            $tblrow.find('.tp').val(row_total.toFixed(2));
                            var grandTotal = 0;

                            $(".tp").each(function () {
                                var stval = parseFloat($(this).val());
                                grandTotal += isNaN(stval) ? 0 : stval;
                            });

                            console.log(grandTotal);

                            $('.subtot').val(grandTotal.toFixed(2));
                            // var tax = $('.invoice_tax').val();



                            // var tax_price=grandTotal/100*tax;
                            //
                            // var final_price=tax_price+grandTotal;

                            //  console.log("cinal"+final_price);

                            final();
                            //  $('.invoice_price').val(final_price.toFixed(2));
                        }
                    });


//
                });

            });



        }
    </script>

    <div class="card uper">
        <div class="card-header">
            Edit Share
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            @endif
            <form method="post" action="{{ route('edit-invoice', $invoicechildren->id) }}">
                {{ method_field('PATCH') }}
                @csrf
                <div class="form-group">
                    <label for="name">Invoice Number:</label>
                    <input type="text" class="form-control" name="invoice_no" value={{ $invoicechildren->invoice_no }} />
                </div>
                <div class="form-group">
                    <label for="service_date"> Service date</label>
                    <input type="text" class="form-control" name="service_date" value={{ $invoicechildren->service_date }} />
                </div>
                <div class="form-group">
                    <label for="place_of_work">{{__('message.place_of_work')}}</label>
                    <input type="text" class="form-control" name="place_of_work" value={{ $invoicechildren->place_of_work }} />
                </div>

                <input type="hidden" id="diff">
                <div class="form-group">
                    <label for="start_time">{{__('message.start_time')}}</label>
                    <input type="text" class="form-control" name="start_time" value={{ $invoicechildren->start_time }} />
                </div>

                <div class="form-group">
                    <label for="end_time">{{__('message.end_time')}}</label>
                    <input type="text" class="form-control" name="end_time" value={{ $invoicechildren->end_time }} />
                </div>

                <div class="form-group">
                    <label for="price_per_hour">{{__('message.price_per_hour')}}</label>
                    <input type="text" class="form-control" name="price_per_hour" value={{ $invoicechildren->price_per_hour }} />
                </div>

                <div class="form-group">
                    <label for="total">{{__('message.total')}}</label>
                    <input type="text" class="form-control" name="total" id="tp2" value={{ $invoicechildren->total }} />
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
