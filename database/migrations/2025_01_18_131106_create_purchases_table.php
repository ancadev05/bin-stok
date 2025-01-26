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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('purchase_code')->unique();
            $table->string('supplier_name')->nullable();
            $table->integer('total_price')->default(0);
            $table->integer('discount')->default(0);
            $table->integer('discount_price')->default(0);
            $table->string('payment_method')->nullable();
            $table->date('date');
            $table->string('status')->default('Pending');
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
