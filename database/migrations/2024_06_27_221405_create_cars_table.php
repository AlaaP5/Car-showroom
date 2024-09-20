<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('model');
            $table->string('image');
            $table->string('mileage');
            $table->string('color');
            $table->string('status');
            $table->string('gear');
            $table->integer('engine');
            $table->integer('speed');
            $table->integer('quantity');
            $table->integer('year');
            $table->longText('details');
            $table->string('fuel');
            $table->float('sumE')->nullable();
            $table->integer('numE')->nullable();
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('company_id')->constrained('companies');
            $table->integer('priceC');
            $table->integer('priceI');
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
        Schema::dropIfExists('cars');
    }
}
