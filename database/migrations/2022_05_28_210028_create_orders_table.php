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
            $table->string('order_id')->nullable();
            $table->string('provider');
            $table->string('url')->nullable();
            $table->unsignedBigInteger('total');
            $table->enum('currency', ['USD', 'COP'])->default('COP');
            $table->enum('status', ['PENDING', 'COMPLETED', 'CANCELED'])->default('PENDING');
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
