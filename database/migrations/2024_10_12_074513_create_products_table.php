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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable()->index();
            $table->string('name')->index();
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('cascade');
            $table->decimal('purchase_price', 10, 2)->nullable();
            $table->decimal('retail_price', 10, 2)->nullable();
            $table->decimal('wholesale_price', 10, 2)->nullable();
            $table->decimal('agent_price', 10, 2)->nullable();
            $table->decimal('reseller_price', 10, 2)->nullable();
            $table->integer('stock')->nullable();
            $table->string('location')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
