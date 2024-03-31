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
            $table->increments('id');
            $table->string('title')->unique();
            $table->string('slug');
            $table->text('short_desc')->nullable();
            $table->text('desc')->nullable();
            $table->string('tags')->nullable();
            $table->unsignedBigInteger('quantity')->default(1);
            $table->integer('regular_price')->default(0);
            $table->integer('offer_price')->nullable();
            $table->string('sku_code')->nullable();
            $table->integer('product_type')->default(0)->comment('0 for New, 1 for Old');
            $table->integer('category_id');
            $table->integer('brand_id');
            $table->integer('featured_item')->default(0)->comment('0 for normal, 1 for featured');
            $table->integer('status')->default(0)->comment('0 for Inactive, 1 for Active');
            $table->text('image')->nullable();
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
