<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{
    protected $table = 'invoices';

    protected $fillable = [
        'invoice_number', 'invoice_date', 'customer','expiry_date','status','sub_total','tax','tax_price','total'
    ];
}
