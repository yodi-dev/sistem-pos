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
        Schema::create('daily_reports', function (Blueprint $table) {
            $table->id();
            $table->date('report_date')->unique();
            $table->decimal('total_income', 15, 2);
            $table->decimal('total_outcome', 15, 2);
            $table->decimal('savings', 15, 2);
            $table->decimal('balance', 15, 2);
            $table->decimal('opening_balance', 15, 2);
            $table->decimal('opening_savings', 15, 2);
            $table->string('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_reports');
    }
};
