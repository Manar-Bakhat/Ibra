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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->text('Description');
            $table->float('Price');
            $table->enum('Size', ['Small', 'Medium', 'Large']);
            $table->bigInteger('Count');
            $table->bigInteger('id_Images');
            $table->string('Color');
            $table->bigInteger('created_By');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
