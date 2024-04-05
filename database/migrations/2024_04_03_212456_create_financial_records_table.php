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
            $table->tinyText('recordid');
            $table->foreignId('farm_farmid')->constrained('farms');
            // $table->tinyText('type_of_finance');
            $table->enum('type_of_finance', ['income', 'expense']);
            $table->tinyText('amount');
            $table->tinyText('date_of_finance');
            $table->longText('details');
            $table->timestamps();
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
