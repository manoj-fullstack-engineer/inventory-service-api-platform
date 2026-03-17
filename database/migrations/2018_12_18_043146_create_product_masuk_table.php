<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductMasukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_masuk', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tanggal');
            // $table->integer('product_id')->unsigned();
            $table->integer('supplier_id')->unsigned();
            $table->string('partsAndConsumables');
            $table->decimal('totalAmount', 12, 2)->default(00.00);
            $table->string('desc');
            $table->timestamps();
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_masuk');
    }
}
