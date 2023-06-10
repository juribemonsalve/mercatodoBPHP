<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('cover_img')->nullable();
            $table->string('name', 100);
            $table->tinyText('description');
            $table->unsignedFloat('price');
            $table->unsignedBigInteger('quantity')->default(0);
            $table->unsignedBigInteger('category_id');
            $table->enum('status', ['active', 'disabled'])->default('active');
            $table->softDeletes();
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
