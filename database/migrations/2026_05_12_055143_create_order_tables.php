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
        Schema::create('shipping_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->unique();
            $table->decimal('cost', 10, 2)->default(0);
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('shipping_method_id')->nullable()->constrained()->nullOnDelete();
            $table->string('order_code', 30)->unique();
            $table->enum('status', ['pending', 'diproses', 'dikirim', 'selesai', 'dibatalkan'])->default('pending');
            $table->string('customer_name', 100);
            $table->string('customer_phone', 20);
            $table->text('customer_address');
            $table->text('note')->nullable();
            $table->decimal('subtotal_price', 12, 2)->default(0);
            $table->decimal('shipping_cost', 10, 2)->default(0);
            $table->decimal('total_price', 12, 2)->default(0);
            $table->text('whatsapp_message')->nullable();
            $table->timestamps();
            
            $table->index('status');
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->nullable()->constrained()->nullOnDelete();
            $table->string('product_name', 150);
            $table->integer('quantity');
            $table->decimal('price', 12, 2);
            $table->decimal('subtotal', 12, 2);
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('shipping_methods');
    }
};
