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
            $table->foreignId('category_id')->constrained();
            $table->string('product_code')->unique();
            $table->string('qr_code')->nullable();
            $table->string('name');
            $table->string('brand');
            $table->string('specifications');
            $table->integer('stock')->default(0);
            $table->integer('min_stock')->default(0);
            $table->integer('cost');
            $table->integer('selling_price');
            $table->string('images')->nullable();
            $table->string('description')->nullable();
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
