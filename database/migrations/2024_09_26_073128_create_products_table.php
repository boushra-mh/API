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
            $table->string('name');
            $table->string('image');
            $table->double('price',8,2); 
            $table->double('discount',8,2)->nullable();   
            $table->integer('amount');
            $table->boolean('is_trendy')->default(false);
            $table->boolean('is_available')->default(true);
            $table->bigInteger('category_id');
            $table->bigInteger('brand_id');
            $table->foreignId('category_id')->references('id')->on('category')->cascadeOnDelete();
            $table->foreignId('brand_id')->references('id')->on('brands')->cascadeOnDelete();
        

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
