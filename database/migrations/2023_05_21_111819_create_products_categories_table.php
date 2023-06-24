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
        Schema::create('products_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('categories_id')->unsigned();
            $table->unsignedBiginteger('products_id')->unsigned();
            $table->foreign('categories_id')->references('id')
                 ->on('categories')->onDelete('cascade');
            $table->foreign('products_id')->references('id')
                ->on('products')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_categories');
    }
};
