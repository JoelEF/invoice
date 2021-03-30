<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invoicechild extends Model
{
    protected $table = 'invoicechildren';

    protected $fillable =
        ['invoice_no', 'service_date', 'place_of_work','start_time','end_time','price_per_hour','total', 'wh'];
}
