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
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('order_number');
            $table->enum('status', ['OK', 'FAILED', 'APPROVED', 'APPROVED_PARTIAL', 'PARTIAL_EXPIRED', 'REJECTED', 'PENDING', 'PENDING_VALIDATION', 'PENDING_PROCESS', 'REFUNDED', 'REVERSED', 'ERROR', 'UNKNOWN', 'MANUAL', 'DISPUTE']);
            $table->integer('item_count');
            $table->float('total');
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
