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
        Schema::create('user_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->unsignedBigInteger('role_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('password');
            $table->string('hashed_password');
            $table->unsignedBigInteger('profile_picture_id')->nullable();
            $table->boolean('is_archive')->default(false);
            $table->dateTime('archived_at')->nullable();
            $table->integer('total_login')->default(0);
            $table->dateTime('last_login')->nullable();
            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('profile_picture_id')->references('id')->on('profile_pictures');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_accounts');
    }
};
