<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('invoice_number');
            $table->string('invoice_date');
            $table->string('expiry_date');
            $table->integer('status');
            $table->string('customer');
            $table->decimal('sub_total');
            $table->integer('tax');
            $table->decimal('tax_price');
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
        Schema::dropIfExists('invoices');
    }
}
