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
        Schema::create('income_and__expenses', function (Blueprint $table) {
            $table->id();
            $table->integer('delta');
            $table->date('date');
            $table->string('description')->nullable();
            $table->foreignId('store_id')->nullable()->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('income_and__expenses');
    }
};
