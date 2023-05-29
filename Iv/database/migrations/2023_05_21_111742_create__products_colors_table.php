<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('_products_colors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('colors_id')->unsigned();
            $table->unsignedBiginteger('products_id')->unsigned();
            $table->foreign('colors_id')->references('id')
                 ->on('colors')->onDelete('cascade');
            $table->foreign('products_id')->references('id')
                ->on('Products')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_products_colors');
    }
};
