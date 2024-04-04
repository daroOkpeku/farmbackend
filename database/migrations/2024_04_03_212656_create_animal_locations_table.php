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
        Schema::create('animal_locations', function (Blueprint $table) {
            $table->id();
            $table->tinyText('locationid');
            $table->foreignId('farm_farmid')->constrained('farms');
            $table->foreignId('animal_animalid')->constrained('animals');
            $table->tinyText('locationdetails');
             $table->tinyText('datemovedin');
             $table->tinyText('datemovedout');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animal_locations');
    }
};
