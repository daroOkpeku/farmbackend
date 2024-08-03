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
        // Schema::create('feeding_schedules', function (Blueprint $table) {
        //     $table->id();
        //     $table->tinyText('scheduleid');
        //     $table->string('animal_animalid');
        //     $table->string('feed_feedid');
        //     $table->tinyText('date_of_feeding');
        //     $table->tinyText('quantity');
        //     $table->timestamps();
        //     //  feedid
        //     $table->foreign('animal_animalid')->references('animalid')->on('animals')->onDelete('cascade');
        //     $table->foreign('feed_feedid')->references('feedid')->on('feeds')->onDelete('cascade');


        // });

        Schema::create('feeding_schedules', function (Blueprint $table) {
            $table->id();
            $table->tinyText('scheduleid');
            $table->string('animal_animalid');
            $table->string('feed_feedid');
            $table->tinyText('date_of_feeding');
            $table->tinyText('quantity');
            $table->timestamps();

            // Add the foreign key constraints
            $table->foreign('animal_animalid')->references('animalid')->on('animals')->onDelete('cascade');
            $table->foreign('feed_feedid')->references('feedid')->on('feeds')->onDelete('cascade');
        });



    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feeding_schedules');
    }
};
