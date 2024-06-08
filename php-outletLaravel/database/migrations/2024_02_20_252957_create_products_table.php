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
            $table->uuid('id')->primary();
            $table->enum('sex', ['unisex', 'woman', 'man'])->default('unisex');
            $table->string('description', 10000)->default(" ");
            $table->string('name',120)->unique();
            $table->decimal('price', 8,2)->default(0.0);
            $table->decimal('price_before', 8,2)->default(0.0);
            $table->integer('stock')->default(0);
            $table->string('image')->default('https://graziamagazine.com/us/wp-content/uploads/sites/15/2023/05/dua-lipa-versace-collection-bts-1.jpg');
            $table->foreignId('category_id')->references('id')->on('categories');
            $table->boolean('isDeleted')->default(false);
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
