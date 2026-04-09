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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->enum('role', ['admin', 'user'])->default('user'); // Default 'user'
            $table->string('username', 50)->unique();
            $table->string('email')->unique(); // Email tetap ada dan unik
            $table->string('password');
            $table->string('nik', 50)->default('-'); // Default '-'
            $table->string('name', 50)->default('Guest'); // Default 'Guest'
            $table->string('address', 50)->default('-');
            $table->date('birth_date')->nullable(); // Nullable jika tidak diisi
            $table->string('gender', 50)->default('unknown'); // Default 'unknown'
            $table->string('phone', 50)->default('-');
            $table->timestamps();
        });


        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
