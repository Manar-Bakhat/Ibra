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
        Schema::create('outfits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('created_By');
            $table->string('name');
            $table->string('description');
            $table->float('Price');
            $table->bigInteger('Size');
            $table->enum('Type', ['Djellaba', 'Kaftan', 'Takchita ', 'Jabador', 'Burnous']);
            $table->bigInteger('id_tags')->unsigned();
            $table->bigInteger('id_Produit')->unsigned();
            $table->bigInteger('id_Images')->unsigned();
            $table->timestamps();
            $table->foreign('id_tags')->references('id')->on('tags')->onDelete('cascade');
            $table->foreign('id_Produit')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('id_Images')->references('id')->on('attachments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outfits');
    }
};
