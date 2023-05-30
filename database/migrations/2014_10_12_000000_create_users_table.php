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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('Gender', ['male', 'female']);
            $table->string('username', 255);
            $table->string('Password', 255);
            $table->string('email', 255);
            $table->string('FirstName', 255);
            $table->string('LastName', 255);
            $table->string('Address', 255);
            $table->string('PhoneNumber', 255);
            $table->unsignedBigInteger('id_role');
            $table->string('NomTitulair', 255);
            $table->timestamp('FinValidation')->nullable();
            $table->string('NumCart', 255);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
