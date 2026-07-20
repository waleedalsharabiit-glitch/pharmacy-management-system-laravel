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
        Schema::create('medicines', function (Blueprint $table) {
           $table->id('medicine_id');
    $table->string('name', 150);
    $table->string('category', 100);
    $table->integer('quantity')->default(0);
    $table->decimal('price', 10, 2);
    $table->date('expiry_date')->nullable();
    // حقل الحالة التلقائي المولد من قاعدة البيانات (Stored Generated Column) كما صممته تماماً
    $table->string('status', 50)->storedAs("CASE WHEN quantity > 0 THEN 'متوفر' ELSE 'غير متوفر' END");
    $table->string('image', 255)->default('default_medicine.png');
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicines');
    }
};
