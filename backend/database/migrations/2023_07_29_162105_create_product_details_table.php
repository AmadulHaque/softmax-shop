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
        Schema::create('product_details', function (Blueprint $table) {
            $table->id();
            $table->string('product_id')->nullable();
            $table->string('title')->nullable();
            $table->string('sub_title')->nullable();
            $table->string('video_one_url')->nullable();
            $table->string('important_title')->nullable();
            $table->string('PD_important_id')->nullable();
            $table->string('important_desc')->nullable();
            $table->string('PD_learn_title')->nullable();
            $table->string('PD_learn_id')->nullable();
            $table->string('gift_id')->nullable();
            $table->string('PD_image_one')->nullable();
            $table->string('PD_image_two')->nullable();
            $table->string('video_two_title')->nullable();
            $table->string('video_two_url')->nullable();
            $table->string('video_desc')->nullable();
            $table->string('review_title')->nullable();
            $table->string('review_video')->nullable();
            $table->string('review_desc')->nullable();
            $table->string('review_images')->nullable();
            $table->string('order_title')->nullable();
            $table->string('order_image')->nullable();
            $table->string('motive_title')->nullable();
            $table->string('order_video_url')->nullable();
            $table->string('motive_title_two')->nullable();
            $table->string('qa_id')->nullable();
            $table->string('book_review_id')->nullable();
            $table->string('book_news_title')->nullable();
            $table->string('book_news_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_details');
    }
};
