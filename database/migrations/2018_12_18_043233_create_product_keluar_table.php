<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductKeluarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_keluar', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tanggal');
            $table->string('productIssueTime');
            
            $table->integer('customer_id')->unsigned();
            $table->string('partsAndConsumables');
            $table->decimal('totalAmount', 12, 2)->default(00.00);
            $table->integer('staff_id')->unsigned();
            $table->string('desc');
            $table->timestamps();
            // $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('staff_id')->references('id')->on('staffs')->onDelete('cascade');
        });
    }



    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_keluar');
    }
}
