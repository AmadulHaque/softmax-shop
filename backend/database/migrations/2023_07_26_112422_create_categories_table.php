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

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name'); 
            $table->string('image')->nullable();
            $table->string('category_style')->default(1);
            $table->string('slug')->unique(); 
            $table->unsignedBigInteger('parent_category')->nullable(); 
            $table->enum('status', [1,0])->default(1); 
            $table->timestamps();
            $table->foreign('parent_category')->references('id')->on('categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
