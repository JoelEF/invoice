

//     var timepicker = new TimePicker('st', {
//         lang: 'en',
//         theme: 'dark'
//     });
// timepicker.on('change', function(evt) {
//
//     var value = (evt.hour || '00') + ':' + (evt.minute || '00');
//     evt.element.value = value;
//
// });

//////////////////////////////////////datatables individual column search//////////////////////
$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#zero_config thead th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search by '+title+'" />' );
    } );

    // DataTable
    var table = $('#zero_config').DataTable(
        {
            "order": []
        }
    );


    // Apply the search
    table.columns().every( function () {
        var that = this;

        $( 'input', this.header() ).on( 'keyup change clear', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );
} );

//////////////////////////////////////datatables individual column search//////////////////////


$(".select2").select2();

jQuery('.mydatepicker').datepicker();
jQuery('#datepicker-autoclose').datepicker({
    autoclose: true,
    todayHighlight: true
});

$('#add-customer-form').validate({
    rules: {

        name: {
            required: true,


        },
        phone: {
            required: true,


        },
        address: {
            required: true,

        },
        kvk: {
            required: true,


        },
    },
    messages: {
        name: {
            required: "Please enter Customer Name",


        },
        phone: {
            required: "Please enter Phone Number",


        },
        address: {
            required: "Please enter Customer Address",

        },
        kvk: {
            required: "Please enter  KVK Number",


        },
    }
});


////dynamic field invoice///

$(document).ready(function (e) {


    calcrow();

    var count=1;

// dynamic_field(count);

    function dynamic_field(count) {

        var html='<tr id="row'+count+'">'


        html += `<td style="width: 15.333%;"> <div class="col-md-12">
        <input type="date"  name=service_Date[] class="form-control date-inputmask service_Date mydatepicker" id="service_Date`+count+`" data-service-Date="`+count+`" placeholder="dd/mm/yyyy" required>
        </div>
        </td>`;
        html += `   <td style="width: 15.333%;"> <div class="col-md-12">
                                                            <input type="text"  name=pol[] class="form-control pol" id="pol`+count+`" data-pol="`+count+`" required>
                                                        </div>
                                                    </td>`;

        html +=` <td style="width: 15.333%;">  <div class="col-md-12">
                                                            <input type="number"  name=st[] class=" stt form-control st" id="st`+count+`" data-st="`+count+`" required>
                                                        </div>
                                                    </td>`

        html+=` <td style="width: 15.333%;">  <div class="col-md-12">
                                                            <input type="number"  name=et[] class="ett form-control et" id="et`+count+`"  data-et="`+count+`" required>
                                                        </div>
                                                    </td>`;

        html+=`  <td style="width: 15.333%;">  <div class="col-md-12">
                                                            <input type="number"  name=pph[] class="ppp form-control pph" id="pph`+count+`" data-pph="`+count+`" required>
                                                        </div>
                                                    </td>`;


        html+=`   <td style="width: 15.333%;">  <div class="col-md-12">
                                                            <input type="number"  name=tp[] class="form-control tp" id="tp`+count+`" data-tp="`+count+`" required>
                                                        </div>
                                                    </td>`;





        html +=' <td><button id="'+count+'" type="button" name="remove"  class="btn btn-danger btn_remove"><i  class="fa fa-trash"></i></button></td>';

        $('#dynamic_field').append(html);


    }

    $('#add').click(function () {

        count++;

        dynamic_field(count);
        calcrow();
    });


    $(document).on('click', '.btn_remove', function(){
        var button_id = $(this).attr("id");
        $('#row'+button_id+'').remove();
    });


});

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
            $tblrow.find('.st , .et  , .pph , .invoice_tax').on('change keyup', function () {

                var s_time = $tblrow.find(".st").val();

                var e_time = $tblrow.find(".et").val();

                //alert('ha');

                var total_time= e_time-s_time ;
                var pph = $tblrow.find(".pph").val();
                // var b_qty = $tblrow.find("[name=bw]").val();

                var row_total= parseInt(pph)*parseInt(total_time);

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
//
$(document).ready(function () {
    // $('.invoice_tax').on('change keyup', function () {
    //
    //     console.log('ahha');
    //
    // });


});

function final() {

    $( ".invoice_tax " ).on('change keyup',function() {

        var tax= $(this).val();

        console.log(tax);

        var grandTotal= $('.subtot').val();
        //  console.log('ha'+grandTotal);

        var tax_price=grandTotal/100*tax;

        $('.invoice_tax_price').val(parseInt(tax_price,10));

        var final_price=parseInt(tax_price,10)  + parseInt(grandTotal,10);

        $('.invoice_price').val(final_price);



    });

}

// var tax_price=grandTotal/100*tax;
//
// var final_price=tax_price+grandTotal;

$('#invoiceform').validate({
    rules: {



        invoice_start_date: {
            required: true,

        },


        invoice_expiry_date: {
            required: true,
            onlynumbers: true

        },

        service_Date: {
            required: true,


        },

    },
    messages: {
        invoice_start_date: {
            required: "Please select invoice Date",


        },

        invoice_expiry_date: {
            required: "Please enter Invoice Expiry Date",


        },

        service_Date: {
            required: "Please enter Service Date",


        },


    }
});
