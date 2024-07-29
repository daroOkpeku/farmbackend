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
        Schema::create('vaccinationschedules', function (Blueprint $table) {
            $table->id();
            $table->tinyText('vaccinationscheduleid');
            // $table->foreignId('species_speciesid')->constrained('species');
            // $table->string('species_speciesid');
            // $table->foreignId('breed_breedid')->constrained('breeds')->nullable();
            $table->string('breed_breedid');
            $table->tinyText('vaccinename');
            $table->tinyText('frequency');
            $table->tinyText('dose');
            $table->tinyText('manufacturer');
            $table->tinyText('statutory_requirement');
            $table->longText('additional_notes');
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
        Schema::dropIfExists('vaccinationschedules');
    }
};
