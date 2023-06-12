<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('reference_order')->nullable();
            $table->integer('item_count');
            $table->string('request_id')->nullable();
            $table->string('process_url')->nullable();
            $table->string('provider');
            $table->unsignedBigInteger('total');
            $table->enum('currency', ['USD', 'COP'])->default('COP');
            $table->enum('status', ['APPROVED', 'PENDING', 'REJECTED', 'APPROVED_PARTIAL', 'PARTIAL_EXPIRED', 'FAILED'])->default('PENDING');
            $table->softDeletes();
            $table->foreign('user_id')->on('user')->references('id');
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
