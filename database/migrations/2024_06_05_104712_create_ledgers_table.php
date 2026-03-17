<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLedgersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ledgers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('srNo');
            $table->date('date');
            $table->integer('staff_id')->unsigned();
            $table->string('action_done');
            $table->string('partsAndConsumables');
            $table->decimal('totalSpent', 10,2);
            $table->integer('preReading')->unsigned();
            $table->integer('todayReading')->unsigned();
            $table->integer('totalReading');
            $table->string('remark');
            $table->foreign('staff_id')->references('id')->on('staffs')->onDelete('cascade');
            $table->foreign('srNo')->references('srno')->on('contract_products')->onDelete('cascade');
            
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
        Schema::dropIfExists('ledgers');
    }
}
