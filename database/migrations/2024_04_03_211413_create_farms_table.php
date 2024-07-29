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
        Schema::create('farms', function (Blueprint $table) {
            $table->id();
            // $table->tinyText('animalid')->unique();
            $table->mediumText('farmname');
            $table->tinyText('farmid')->unique();
            $table->tinyText('location');
            $table->tinyText('owner');
            $table->tinyText('size');
            $table->tinyText('farmtype');
            $table->tinyText('contact_details');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farms');
    }
};
