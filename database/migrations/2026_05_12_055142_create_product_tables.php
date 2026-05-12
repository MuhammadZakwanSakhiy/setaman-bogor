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
            $table->string('name', 100)->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->string('name', 150);
            $table->string('slug', 180)->unique();
            $table->text('description')->nullable();
            $table->text('care_tips')->nullable();
            $table->decimal('price', 12, 2)->default(0);
            $table->integer('stock')->default(0);
            $table->text('image_url')->nullable();
            $table->boolean('is_best_seller')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index(['is_active', 'category_id']);
        });

        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->text('image_url');
            $table->integer('sort_order')->default(0);
            $table->timestamp('created_at')->useCurrent();
        });

        Schema::create('product_tags', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->unique();
            $table->timestamps();
        });

        Schema::create('product_tag_relations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('tag_id')->constrained('product_tags')->cascadeOnDelete();
            $table->unique(['product_id', 'tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_tag_relations');
        Schema::dropIfExists('product_tags');
        Schema::dropIfExists('product_images');
        Schema::dropIfExists('products');
        Schema::dropIfExists('categories');
    }
};
