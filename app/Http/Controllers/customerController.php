<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function viewCustomers()
    {
        $customers=Customer::latest('id')->get()->toArray();

//        var_dump($customer);
//        die();

        return view('customer',compact('customers'));
    }

    public function addcustomer(Request $request){

        $this->validate( $request , [

            'name'=> 'required',
            'phone'=> 'required|string',
            'zip'=> 'required|string',
            'btw'=> 'required|string',
            'address'=> 'required|string',
            'country'=> 'required|string',
            'kvk'=> 'required',

        ]);

        $customer=Customer::create([
            'name' => $request['name'],
            'phone' => $request['phone'],
            'zip' => $request['zip'],
            'btw' => $request['btw'],
            'address' => $request['address'],
            'country' => $request['country'],
            'kvk'  => $request['kvk'],


        ]);




        return redirect('customers')->with('message','New Customer Added Successfully');

    }

}
