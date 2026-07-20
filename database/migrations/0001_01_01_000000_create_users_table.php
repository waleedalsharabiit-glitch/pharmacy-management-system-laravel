<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(){

       Schema::create('users', function (Blueprint $table) {
          $table->id('user_id');
          $table->string('username',100);
          $table->string('password',255);
          $table->string('email',255)->unique();
          $table->enum('gender', ['male', 'female'])->nullable();
            $table->string('address',255)->nullable();
            $table->string('phone',20)->nullable();
            $table->string('role',20)->default('user');
            $table->timestamps();
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
