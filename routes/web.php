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

Route::get('/account-setting','HomeController@accountsetting')->name('account-setting');
Route::post('/accountsettingupdate','HomeController@accountsettingupdate')->name('account-setting-update');

Route::get('/customers','CustomerController@viewCustomers')->name('view-customers');
Route::post('/add-customer','CustomerController@addcustomer')->name('add-customer');



Route::get('/create/invoice','invoiceController@createInvoice')->name('create-invoice');
Route::get('/edit/invoice/{id}','invoiceController@editInvoice')->name('edit-invoice');
Route::patch('/edit/invoice/{id}','invoiceController@update');
Route::post('/submit/invoice','invoiceController@submitInvoice')->name('submit-invoice');
Route::get('/view/pending/invoice','invoiceController@viewpendingInvoices')->name('view-pending-invoices');
Route::get('/view/approve/invoice','invoiceController@viewapprovedInvoices')->name('view-approved-invoices');

Route::get('approve-invoice/{id}', ['as' => 'approve.invoice', 'uses' => 'invoiceController@approveinvoice']);

Route::get('generate-pdf/{id}','invoiceController@generatePDF');


