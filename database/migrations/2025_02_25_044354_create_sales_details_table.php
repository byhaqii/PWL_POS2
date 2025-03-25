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
        Schema::create('sales_details', function (Blueprint $table) {
            $table->id('detail_id');
            $table->foreignId('sales_id')->references('sales_id')->on('sales')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('item_id')->references('item_id')->on('items')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('detail_qty');
            $table->integer('detail_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_details');
    }
};
