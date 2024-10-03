<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('invoice_id')->comment('ID Factura');
            $table->string('description')->nullable()->comment('Descripcion del Item');
            $table->integer('quantity')->unsigned()->nullable()->comment('Cantidad del Item');
            $table->float('value')->unsigned()->nullable()->comment('Valor del Item');
            $table->float('total_value')->unsigned()->nullable()->comment('Total del Item');

            $table->foreign('invoice_id')->references('id')->on('invoices');            

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_items');
    }
}
