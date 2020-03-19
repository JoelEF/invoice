<?php

namespace App\Http\Controllers;

use App\Customer;
use App\invoice;
use App\invoicechild;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Response;

class InvoiceController extends Controller
{

//$invoice_due_date = Carbon::parse($request->invoice_due_date);

    public function createInvoice()
    {


        $customer=Customer::all()->toArray();

        $in = new invoice();
        $last_invoice_id=$in->orderBy('id', 'DESC')->pluck('id')->first();

        $now = Carbon::now();

       // dd($last_invoice_id);


        //$invoiceno=0;

        if($last_invoice_id!= null)
        {

            $nowid=$last_invoice_id + 1;


            $invoiceno=sprintf("%03d", $nowid);
          //  dd($last_invoice_id);
            $year=sprintf("%02d", $now->weekOfYear);
            $invoiceno=$now->year.$year.$invoiceno;


        }

        else
        {
            $invoicenoc=sprintf("%03d", 1);

            $year=sprintf("%02d", $now->weekOfYear);
            $invoiceno=$now->year.$year.$invoicenoc;
        }
        // dd($invoicenoc);

        return view('create-invoice',compact('customer','invoiceno'));
    }


    public function submitInvoice(Request $request)
    {



        $validation=Validator::make($request->all(),[


            'invoice_no' => 'required',
            'invoice_start_date' => 'required',
            'customer_name' => 'required',
            'invoice_expiry_date'=> 'required',

        ]);

       // dd($request['invoice_tax_price']);

        if($validation->passes())
        {

            $createinvoice=invoice::create ([

                'invoice_number' => $request['invoice_no'],
                'invoice_date' => $request['invoice_start_date'],
                'customer' => $request['customer_name'],
                'expiry_date' => $request['invoice_expiry_date'],
                'status' => 0,
                'sub_total' => $request['subtot'],
                'tax' => $request['invoice_tax'],
                'tax_price' => $request['invoice_tax_price'],
                'total' => $request['invoice_price'],

            ]);

            if($createinvoice):

                $invoiceid=invoice::where('invoice_number',$request['invoice_no'])->get();

                $current_invoice_id=$invoiceid[0]->id;
//            var_dump($truckid[0]->id);
//            die();

                for ($i = 0; $i < count($request['pol']); $i++) {
                    $getProduct[] = [
                        'invoice_no' => $current_invoice_id,
                        'service_date' => $request['service_Date'][$i],
                        'place_of_work' => $request['pol'][$i],
                        'start_time' => $request['st'][$i],
                        'end_time' => $request['et'][$i],
                        'price_per_hour' => $request['pph'][$i],
                        'total' => $request['tp'][$i],
                    ];
                }

                invoicechild::insert($getProduct);


                return redirect('/view/pending/invoice')->with('message','Invoice Submitted Successfully');
            endif;
        }

        else
        {
          return redirect()->back()->with('error',$validation->errors()->all());
        }




    }

    public function viewpendingInvoices()
    {
        $invoice=invoice::where('status',0)
            ->join('customers', 'invoices.customer', '=', 'customers.id')
            ->select('invoices.*', 'customers.name as userName')
            ->latest('invoices.id')
            ->get();

       // dd($invoice);



        return view('pending-invoices',compact('invoice'));
    }


    public function viewapprovedInvoices()
    {
        $invoice=invoice::where('status',1)
            ->join('customers', 'invoices.customer', '=', 'customers.id')
            ->select('invoices.*', 'customers.name as userName')
            ->latest('invoices.id')
            ->get();


        return view('approved-invoices',compact('invoice'));
    }

    public function approveinvoice($id)
    {

        $invoice=invoice::find($id);

      //  dd($invoice);

        $invoice->status=1;

        $invoice->save();

        return redirect()->back()->with('message','Invoice Approved');

    }


    public function editInvoice($id){

        $invoicechildren = invoicechild::find($id);

        return view('edit-invoice', compact('invoicechildren'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'invoice_no'=>'required',
            'service_date'=> 'required|',
            'place_of_work' => 'required|',
            'start_time' => 'required|',
            'end_time' => 'required|',
            'price_per_hour' => 'required|',
            'total' => 'required|',
        ]);

        $share = invoicechild::find($id);
        $share->invoice_no = $request->get('invoice_no');
        $share->service_date = $request->get('service_date');
        $share->place_of_work = $request->get('place_of_work');
        $share->start_time = $request->get('start_time');
        $share->end_time = $request->get('end_time');
        $share->price_per_hour = $request->get('price_per_hour');
        $share->total = $request->get('total');
        $share->save();

        return redirect('/shares')->with('success', 'Invoice updated');
    }


    public function generatePDF($id)
    {

        $invoice=invoice::findOrFail($id);

        $invoicechildd=invoicechild::where('invoice_no',$invoice->id)->get();

        $customer=Customer::find($invoice->customer);


        $starttime =invoicechild::findOrFail($id);


        $start = date_create($starttime->start_time);  //start time

        $end = date_create($starttime->end_time); // end time

        $diff = date_diff($start, $end);

        $date = $diff->h . ':' . $diff->i . ':' . $diff->s;

        $hours = date("H:i", strtotime($date));

        list($h, $m) = explode(':', $hours);  //Split up string into hours/minutes
        $decimal = $m / 60;  //get minutes as decimal
        $hoursAsDecimal = $h + $decimal;





        $pdf = PDF::loadView('invoicetemplate', compact('invoice','invoicechildd','customer', 'hoursAsDecimal'));






        return $pdf->stream($invoice->invoice_number.'-invoice.pdf');

//        $output = $pdf->output();
//
//        return new Response($output, 200, [
//            'Content-Type' => 'application/pdf',
//            'Content-Disposition' =>  'inline; filename="invoice.pdf"',
//        ]);

    }
}
