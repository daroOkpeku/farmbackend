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
        Schema::create('farmdetails', function (Blueprint $table) {
            $table->id();
            $table->tinyText('phone')->nullable();
            $table->tinyText('email')->nullable();
            $table->tinyText('website')->nullable();
            $table->foreignId('farm_farmid')->constrained('farms');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farmdetails');
    }
};
