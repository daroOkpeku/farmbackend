<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 'name',
        // 'sex',
        // 'age',
        // 'breed',
        // 'weight',
        // 'tag_id',
        // 'health_status',
        // 'farm_farmid'
        Schema::create('animal_livestocks', function (Blueprint $table) {
            $table->id();
            $table->tinyText('name')->nullable();
            $table->enum('sex', ['Male', 'Female']);
            $table->string('image')->nullable();
            $table->tinyInteger('age')->nullable();
            $table->tinyText('breed')->nullable();
            $table->string('weight')->nullable();
            $table->string('tag_id')->unique()->nullable();
            $table->string('health_status')->nullable();
            $table->string('farm_farmid')->nullable();
            $table->timestamps();
            $table->foreign('farm_farmid')->references('farmid')->on('farms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animal_livestocks');
    }
};
