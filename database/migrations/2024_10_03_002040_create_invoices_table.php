<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();

            $table->string('number')->nullable()->comment('Numero de la Factura.');
            $table->dateTime('date')->nullable()->comment('Fecha de la Factura.');

            $table->string('emitter_identification')->nullable()->comment('Identificacion Emisor de la Factura');
            $table->string('emitter_name')->nullable()->comment('Nombre Emisor de la Factura');

            $table->string('receiver_identification')->nullable()->comment('Identificacion Receptor de la Factura');
            $table->string('receiver_name')->nullable()->comment('Nombre Receptor de la Factura');

            $table->float('total_value')->nullable()->comment('Valor Total de la Factura');
            $table->float('iva')->nullable()->comment('Valor IVA de la Factura');
            $table->float('total_value_iva')->nullable()->comment('Valor Total mas IVA de la Factura');

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
        Schema::dropIfExists('invoices');
    }
}
