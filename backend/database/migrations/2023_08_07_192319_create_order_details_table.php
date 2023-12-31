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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->integer('order_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->double('selling_qty')->nullable();
            $table->double('unit_price')->nullable();
            $table->double('selling_price')->nullable();
            $table->string('department')->nullable();
            $table->string('semester')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
