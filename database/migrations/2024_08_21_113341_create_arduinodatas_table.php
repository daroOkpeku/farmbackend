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

        Schema::create('arduinodatas', function (Blueprint $table) {
            $table->id();
            $table->string('voltage')->nullable();
            $table->string('current')->nullable();
            $table->string('frequency')->nullable();
            $table->string('power')->nullable();
            $table->string('energy')->nullable();
            $table->string('runtime')->nullable();
            $table->string('temperature')->nullable();
            $table->string('oil_level')->nullable();
            $table->string('oil_quality')->nullable();
            $table->string('fuel_level')->nullable();
            $table->string('rpm')->nullable();
            $table->string('gyration')->nullable();
            $table->string('health_status')->nullable();
            $table->string('arduinodatas_id')->nullable();

            $table->timestamps();
            $table->foreign('arduinodatas_id')->references('tag_id')->on('animal_livestocks')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arduinodatas');
    }
};
