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
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->tinyText('animalid');
            $table->foreignId('specie_speciesid')->constrained('species');
            $table->foreignId('breed_breedid')->constrained('breeds');
            $table->tinyText('tagnumber');
            // $table->tinyText('sex');
            $table->enum('sex', ['Male', 'Female']);
            $table->tinyText('date_of_birth');
            $table->tinyText('acquisition_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
