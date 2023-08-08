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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('wp_phone')->nullable();
            $table->string('fb_page')->nullable();
            $table->string('fb_group')->nullable();
            $table->string('youtube')->nullable();
            $table->string('shop_title')->nullable();
            $table->string('address')->nullable();
            $table->string('address_two')->nullable();
            $table->string('currency')->default('$');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
