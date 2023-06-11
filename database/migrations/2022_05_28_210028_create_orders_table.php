<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('reference_order')->nullable();
            $table->integer('item_count');
            $table->string('request_id')->nullable();
            $table->string('process_url')->nullable();
            $table->string('provider');
            $table->unsignedBigInteger('total');
            $table->enum('currency', ['USD', 'COP'])->default('COP');
            $table->enum('status', ['APPROVED', 'PENDING', 'REJECTED', 'APPROVED_PARTIAL', 'PARTIAL_EXPIRED', 'FAILED'])->default('PENDING');

            $table->softDeletes();
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
