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
            $table->string('code')->nullable()->unique();
            $table->string('name');
            $table->string('category')->nullable();
            $table->string('category_label')->nullable();
            $table->enum('metal',["silver","gold","rose_gold"])->nullable();
            $table->json('available_metals')->nullable();
            $table->decimal('price', 10, 2);
            $table->decimal('original_price', 10, 2)->nullable();
            $table->decimal('rating', 3, 2)->default(5.00);
            $table->unsignedInteger('reviews_count')->default(0);
            $table->string('badge')->nullable();
            $table->string('image')->default('assets/images/prod-solitaire-ring.jpg');
            $table->string('secondary_image')->nullable();
            $table->json('sizes')->nullable();
            $table->text('description');
            $table->text('artisan_notes')->nullable();
            $table->integer('in_stock')->default(5);
            $table->boolean('is_featured')->default(false);
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
