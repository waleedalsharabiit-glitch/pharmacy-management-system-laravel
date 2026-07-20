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
        Schema::create('issued_medicines', function (Blueprint $table) {
           $table->id('issue_id');
    $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
    $table->foreignId('medicine_id')->constrained('medicines', 'medicine_id')->onDelete('cascade');
    $table->integer('quantity_issued')->default(1);
    $table->string('prescription_img', 255)->nullable();
    $table->string('status', 50)->default('قيد المراجعة'); // (قيد المراجعة, تم الصرف, مرفوض)
    $table->text('notes')->nullable();
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issued_medicines');
    }
};
