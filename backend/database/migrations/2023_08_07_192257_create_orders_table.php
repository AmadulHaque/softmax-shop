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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_no');
            $table->string('customer_id');
            $table->string('pay_type');
            $table->string('pay_number')->nullable();
            $table->integer('amount');
            $table->integer('tax')->nullable();
            $table->integer('shipping')->nullable();
            $table->integer('discount')->nullable();
            $table->string('ship_name')->nullable();
            $table->string('ship_email')->nullable();
            $table->string('ship_phone')->nullable();
            $table->string('ship_address')->nullable();
            $table->string('ship_postal_code')->nullable();
            $table->string('transaction_id')->nullable();
            $table->date('date')->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('role')->default('processing');
            $table->tinyInteger('status')->default('0');
            $table->integer('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
