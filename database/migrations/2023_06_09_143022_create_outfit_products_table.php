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
        Schema::create('outfits_products', function (Blueprint $table) {
            $table->unsignedBigInteger('outfits_id');
            $table->unsignedBigInteger('products_id');
            $table->integer('x');
            $table->integer('y');
            $table->timestamps();

            $table->primary(['outfits_id', 'products_id']);
            $table->foreign('outfits_id')->references('id')->on('outfits')->onDelete('cascade');
            $table->foreign('products_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('outfit_products');
    }
};
