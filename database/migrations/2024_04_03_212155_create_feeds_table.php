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
        Schema::create('feeds', function (Blueprint $table) {
            $table->id();
            $table->string('feedid')->unique();
            $table->tinyText('feedtype');
            $table->longText('feeddetails');
            $table->string('cost');
            $table->string('producationtype');
            $table->string('ration');
            $table->string('ration_composition');
            $table->string('disorders');
            $table->string('tagnumber');
            $table->timestamps();
            $table->foreign('tagnumber')->references('tag_id')->on('animal_livestocks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feeds');
    }
};
