<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('main');
    }


    public function accountsetting(){

        $User=Auth::user();

        $getuser=User::where('email',$User->email)->get()->first();

//            var_dump($getuser);
//            die();

        return view('account-setting',compact('getuser'));


    }

    public function accountsettingupdate(Request $request)
    {
        $this->validate( $request,[

            'old_pass' =>'required|string',
            'new_pass' => 'required|string|min:6'


        ]);

        $user=Auth::user();

        $userpassword=$user->password;
        $getcurrentpass=$request->old_pass;
        $getnewpass=$request->new_pass;

        if(!Hash::check($getcurrentpass,$userpassword)):


            return redirect('account-setting')->with('message','Incorrect old password');

        endif;

        $newpassword=Hash::make($getnewpass);

//        var_dump($newpassword);
//        die();
        $user->password=$newpassword;
        $user->save();

        return redirect('account-setting')->with('message1','Password Updated Successfully');



    }
}
