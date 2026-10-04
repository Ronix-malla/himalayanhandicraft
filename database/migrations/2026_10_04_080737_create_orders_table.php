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
            $table->string('order_number')->unique();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->string('street_address');
            $table->string('landmark')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('pincode');
            $table->text('delivery_notes')->nullable();
            $table->string('payment_method')->default('cod');
            $table->string('payment_status')->default('pending'); // pending, paid, failed
            $table->string('order_status')->default('confirmed'); // confirmed, processing, shipped, delivered, cancelled
            $table->decimal('subtotal', 10, 2);
            $table->decimal('discount_amount', 10, 2)->default(0.00);
            $table->string('coupon_code')->nullable();
            $table->decimal('shipping_amount', 10, 2)->default(0.00);
            $table->decimal('gift_wrap_amount', 10, 2)->default(0.00);
            $table->decimal('total_amount', 10, 2);
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
