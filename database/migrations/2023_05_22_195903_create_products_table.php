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
            $table->bigIncrements('id');
            $table->string('Name', 255);
            $table->text('Description');
            $table->float('Price');
            $table->enum('Size', ['small', 'medium', 'large']); // Replace 'small', 'medium', 'large' with appropriate values
            $table->unsignedBigInteger('count');
            $table->unsignedBigInteger('id_Images');
            $table->string('Color', 255);
            $table->timestamp('created_at')->nullable();
            $table->unsignedBigInteger('created_By');
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
