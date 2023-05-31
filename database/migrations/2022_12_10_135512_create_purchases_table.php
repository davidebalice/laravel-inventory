<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();

            $table->integer('supplier_id')->default('0');
            $table->integer('unit_id')->default('0');
            $table->integer('product_id')->default('0');
            $table->string('purchase_no')->nullable();
            $table->date('date')->nullable();
            $table->string('description')->nullable();
            $table->integer('buying_qty')->default('0');
            $table->double('unit_price')->default('0');
            $table->double('buying_price')->default('0');
            $table->tinyInteger('status')->default('0')->comment("0=Pending,1=Approved");
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('purchases');
    }
};
