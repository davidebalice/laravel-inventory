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
        Schema::create('footers', function (Blueprint $table) {
            $table->id();
            $table->string('number')->nullable;
            $table->text('short_description')->nullable;
            $table->text('short_description2')->nullable;
            $table->text('short_description3')->nullable;
            $table->string('address')->nullable;
            $table->string('email')->nullable;
            $table->string('facebook')->nullable;
            $table->string('twitter')->nullable;
            $table->string('linkedin')->nullable;
            $table->string('copyright')->nullable;
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
        Schema::dropIfExists('footers');
    }
};
