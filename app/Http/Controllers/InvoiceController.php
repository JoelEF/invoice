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
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class InvoiceController extends Controller
{

//$invoice_due_date = Carbon::parse($request->invoice_due_date);

    public function createInvoice()
    {


        $customer=Customer::all()->toArray();

        $in = new invoice();
        $last_invoice_id=$in->orderBy('id', 'DESC')->pluck('id')->first();
        // $last_invoice_id = 26;

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
            $invoicenoc=sprintf("%03d", 16);

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
                        'wh' => $request['wh'][$i],
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

////        $invoicechildren = invoicechild::find($id);
//        $invoice=invoice::where($id)
//            ->join('invoicechildren', 'invoice.id', '=', 'invoicechildren.invoice_no');
//        $customer = Customer::all();
        
        $invoice=invoice::findOrFail($id);

        $invoicechildd=invoicechild::where('invoice_no',$invoice->id)->orderBy('service_date','asc')->get();
        $customer=Customer::find($invoice->customer);

        return view('edit-invoice', compact('invoice', 'invoicechildd', 'customer'));
    }


//    
    
    
        public function update(Request $request, $id ) {
            // $request->validate([
            //     'invoice_no'=>'required',
            //     'service_date'=> 'required',
            //     'place_of_work' => 'required',
            //     'start_time' => 'required',
            //     'end_time' => 'required',
            //     'worked_hours' => 'required',
            //     'price_per_hour' => 'required',
            //     'total' => 'required',
            // ]);
            $invoice=invoice::findOrFail($id);

        $invoicechildd=invoicechild::where('invoice_no',$invoice->id)->orderBy('service_date','asc')->get();
        // $invoice = invoicechild::findOrFail($invoice->id);
        
        invoice::where('id', $id)->update([
            'sub_total' =>$request->subtot,
            'total'=>$request->invoice_price,
            'tax'=>$request->invoice_tax,
        ]);
            foreach($invoicechildd as $key => $val){
                invoicechild::where('id', $val->id)->update([
                    'invoice_no' => $id,
                    'service_date' => $request->service_Date[$key],
                    'place_of_work' => $request->pol[$key],
                    'start_time' => $request->st[$key],
                    'end_time' => $request->et[$key],
                    'wh' => round($request->wh[$key], 2),
                    'price_per_hour' => $request->pph[$key],
                    'total' => $request->tp[$key],
                    
       

                    ]);
            }
            
            return redirect('view/pending/invoice');


          }


    public function generatePDF($id)
    {

        $invoice=invoice::findOrFail($id);

        $invoicechildd=invoicechild::where('invoice_no',$invoice->id)->orderBy('service_date','asc')->get();

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

    public function destroy($id)
    {

        $invoice = 'DELETE invoices,invoicechildren FROM invoices
          INNER JOIN invoicechildren ON invoicechildren.invoice_no = invoices.id
          WHERE invoices.id = ?';


        DB::delete($invoice,  array($id));

        return redirect('view/pending/invoice');
    }
}
