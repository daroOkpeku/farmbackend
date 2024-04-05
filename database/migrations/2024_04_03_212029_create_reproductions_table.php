<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reproductions', function (Blueprint $table) {
            $table->id();
            $table->tinyText('reproductionid');
            $table->foreignId('animal_animalid')->constrained('animals');
            $table->tinyText('breedingdate');
            $table->tinyText('pregnancycheckdate');
            // $table->tinyText('outcome');
            $table->enum('outcome', ['pregnant', 'not pregnant']);
            // DB::statement("ALTER TABLE reproductions CHANGE COLUMN ");
            $table->tinyText('birtheventdate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reproductions');
    }
};
