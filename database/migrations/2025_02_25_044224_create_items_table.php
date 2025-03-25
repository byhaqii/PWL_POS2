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
        Schema::create('items', function (Blueprint $table) {
            $table->id('item_id');
            $table->foreignId('category_id')->references('category_id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->string('item_code', 10)->unique();
            $table->string('item_name', 100);
            $table->integer('item_buy_price');
            $table->integer('item_sell_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
