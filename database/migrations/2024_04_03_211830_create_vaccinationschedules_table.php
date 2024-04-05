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
            $table->foreignId('species_speciesid')->constrained('species');
            $table->foreignId('breed_breedid')->constrained('breeds')->nullable();
            $table->tinyText('vaccinename');
            $table->tinyText('frequency');
            $table->tinyText('dose');
            $table->tinyText('manufacturer');
            $table->tinyText('statutory_requirement');
            $table->longText('additional_notes');
            $table->timestamps();
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
