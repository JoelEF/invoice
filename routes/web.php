<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/', function () {

    if(Auth::guard()->check())
    {

        return redirect('/home');
    }
    else{
        return redirect('/login');
    }
});

Route::get('/account-setting','HomeController@accountsetting')->name('account-setting')->middleware('auth');
Route::post('/accountsettingupdate','HomeController@accountsettingupdate')->name('account-setting-update')->middleware('auth');

Route::get('/customers','CustomerController@viewCustomers')->name('view-customers')->middleware('auth');
Route::post('/add-customer','CustomerController@addcustomer')->name('add-customer')->middleware('auth');



Route::get('/create/invoice','InvoiceController@createInvoice')->name('create-invoice')->middleware('auth');


Route::get('edit/invoice/{id}', ['as' => 'invoice.editInvoice', 'uses' => 'InvoiceController@editInvoice'])->middleware('auth');

Route::patch('update/invoice/{id}', ['as' => 'invoice.update', 'uses' => 'InvoiceController@update'])->middleware('auth');

Route::post('/submit/invoice','InvoiceController@submitInvoice')->name('submit-invoice')->middleware('auth');;
Route::get('/view/pending/invoice','InvoiceController@viewpendingInvoices')->name('view-pending-invoices')->middleware('auth');
Route::get('/view/approve/invoice','InvoiceController@viewapprovedInvoices')->name('view-approved-invoices')->middleware('auth');

Route::get('approve-invoice/{id}', ['as' => 'approve.invoice', 'uses' => 'InvoiceController@approveinvoice'])->middleware('auth');
 
Route::get('generate-pdf/{id}', ['as' => 'invoice.generatePDF', 'uses' => 'InvoiceController@generatePDF'])->middleware('auth');


Route::delete('pending/invoice/{id}', ['uses' => 'InvoiceController@destroy', 'as' => 'invoice.delete']);


