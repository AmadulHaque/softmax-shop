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
            $table->longText('summery')->nullable();
            $table->longText('description')->nullable();
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('brand_id');
            $table->unsignedInteger('unit_id');
            $table->string('size')->nullable();
            $table->string('color')->nullable();
            $table->double('qty')->default('0');
            $table->unsignedInteger('price');
            $table->unsignedInteger('offer_price')->nullable();
            $table->string('slug')->unique(); 
            $table->longText('tags')->nullable(); 
            $table->longText('meta_title')->nullable();
            $table->longText('meta_keyword')->nullable();
            $table->longText('meta_desc')->nullable();
            $table->enum('status', [1,0])->default(1); 
            $table->enum('trending', [1,0])->default(0); 
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
