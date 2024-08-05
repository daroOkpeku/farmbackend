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
        Schema::create('productions', function (Blueprint $table) {
            $table->id();
            $table->tinyText('productionid');
            $table->string('animal_animalid');
            $table->tinyText('date_of_producation');
            $table->tinyText('production_type');
            $table->tinyText('quantity');
            $table->tinyText('weight');
            $table->string('production_cycle')->nullable();
            $table->string('yield')->nullable();
            $table->string('cost')->nullable();
            $table->string('disorders')->nullable();
            $table->string('estrus_cycle_start_date')->nullable();
            $table->string('estrus_cycle_end_date')->nullable();
            $table->string('tagnumber')->nullable();
            $table->timestamps();
            $table->foreign('animal_animalid')->references('animalid')->on('animals')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productions');
    }
};
