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
        Schema::create('holidays', function (Blueprint $table) {
            $table->id();
            $table->date('holiday_date')->unique()->comment('Ngày nghỉ lễ');
            $table->string('name', 255)->comment('Tên ngày nghỉ lễ');
            $table->boolean('is_paid')->default(true)->comment('Chỉ định xem ngày nghỉ lễ có được trả lương hay không');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('holidays');
    }
};
