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
            $table->tinyText('name')->nullable();
            $table->string('breed_breedid');
            $table->tinyText('tagnumber');
            $table->enum('sex', ['Male', 'Female']);
            $table->tinyText('date_of_birth');
            $table->tinyText('acquisition_date');
            $table->timestamps();

            // $table->foreign('species_speciesid')->references('speciesid')->on('species')->onDelete('cascade');
            $table->foreign('breed_breedid')->references('breedid')->on('breeds')->onDelete('cascade');

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
