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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id('stock_id');
            $table->foreignId('item_id')->references('item_id')->on('items')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('user_id')->references('user_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('stock_qty');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
