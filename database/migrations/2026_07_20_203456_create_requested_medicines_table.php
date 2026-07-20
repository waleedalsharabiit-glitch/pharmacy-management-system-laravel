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
    Schema::create('requested_medicines', function (Blueprint $table) {
    $table->id('request_id');
    $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
    $table->string('medicine_name', 150);
    $table->string('category', 100)->nullable();
    $table->integer('quantity_requested')->default(1);
    $table->string('status', 50)->default('قيد الانتظار'); // (قيد الانتظار, تمت الموافقة وتوفيره, مرفوض)
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requested_medicines');
    }
};
