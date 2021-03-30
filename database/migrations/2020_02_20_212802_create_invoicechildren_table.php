<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicechildrenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('invoicechildren', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('invoice_no')->unsigned();
            $table->foreign('invoice_no')->references('id')->on('invoice');
            $table->string('service_date');
            $table->string('place_of_work');
            $table->string('start_time');
            $table->string('end_time');
            $table->decimal('price_per_hour');
            $table->decimal('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoicechildren');
    }
}
