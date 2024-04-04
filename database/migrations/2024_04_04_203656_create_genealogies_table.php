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
        Schema::create('genealogies', function (Blueprint $table) {
            $table->id();
            $table->tinyText('genealogyid');
            $table->foreignId('animal_animalid')->constrained('animals');
            $table->tinyText('parenttype');
            $table->tinyText('parentanimalid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('genealogies');
    }
};
