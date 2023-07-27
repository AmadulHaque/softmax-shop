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
            $table->string('title'); 
            $table->string('thumbnail');
            $table->string('images')->nullable();
            $table->longText('summery');
            $table->longText('description');
            $table->string('category_id');
            $table->string('brand_id');
            $table->string('unit_id');
            $table->string('size');
            $table->string('color');
            $table->string('color');
            $table->string('slug')->unique(); 
            $table->longText('tags'); 
            $table->enum('status', [1,0])->default(1); 
            $table->enum('trending', [1,0])->default(0); 
            $table->timestamps();
            $table->foreign('parent_category')->references('id')->on('categories')->onDelete('set null');
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
