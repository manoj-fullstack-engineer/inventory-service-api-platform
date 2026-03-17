<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cpname');
            $table->integer('category_id')->unsigned();
            $table->string('pmodel');
            $table->string('srno')->unique();
            $table->string('price');
            // $table->string('image')->default(null);
            $table->integer('cust_id')->unsigned();
            $table->string('agrStatus');
            $table->string('agrNo');
            $table->string('agrDos');
            $table->string('agrDoe');
            $table->string('remark');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('cust_id')->references('id')->on('customers')->onDelete('cascade');
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
        Schema::dropIfExists('contract_products');
    }
}
