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

        Schema::create('health_records', function (Blueprint $table) {
            $table->id();
            $table->tinyText('recordid');
            $table->foreignId('animal_animalid')->constrained('animals');
            $table->string('vacation_date');
            $table->string('vaccine_name');
            $table->string('treatments');
            $table->string('treatments_date');
            $table->string('illness');
            $table->string('cost');
            $table->string('treated_by_vcn_number');
            $table->string('status');
            $table->string('tagnumber');
            $table->longText('details');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('health_records');
    }
};
