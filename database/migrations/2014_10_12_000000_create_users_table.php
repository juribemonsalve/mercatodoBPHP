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
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->enum('documentType', ['CC', 'CE', 'TI', 'NIT', 'RUT']);
            $table->string('document')->unique();
            $table->string('name');
            $table->string('surname');
            $table->string('full_name')->virtualAs('CONCAT(name, " ", surname)');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('mobile');
            $table->string('address');
            $table->string('password');
            $table->enum('status', ['active', 'disabled'])->default('active');
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
