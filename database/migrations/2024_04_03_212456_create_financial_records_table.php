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

        Schema::create('financial_records', function (Blueprint $table) {
            $table->id();
             $table->string('tagnumber');
             $table->string('production_type');
             $table->string('date_fin');
             $table->string('items');
             $table->string('input_cost');
             $table->string('yield');
             $table->string('current_value');
             $table->string('revenue');
             $table->string('profit');
            $table->timestamps();
            $table->foreign('tagnumber')->references('tag_id')->on('animal_livestocks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial_records');
    }
};
