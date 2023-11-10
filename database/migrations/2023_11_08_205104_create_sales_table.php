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
        //table ventas
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('price_total')->nullable();
            $table->string('quantity')->nullable();

            $table->foreignId('product_id')->references('id')->on('products')->onDelete('cascade')->nullable();

            $table->foreignId('menu_id')->references('id')->on('menus')->onDelete('cascade')->nullable();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade')->nullable();

            // $table->foreign('menu_id')->references('id')->on('menu')->onDelete('cascade');
            // $table->unsignedBigInteger('menu_id')->nullable();
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
