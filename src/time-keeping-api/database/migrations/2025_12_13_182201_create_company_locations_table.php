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
        Schema::create('company_locations', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->comment('Tên địa điểm công ty');
            $table->string('latitude', 50)->comment('Vĩ độ của địa điểm công ty');
            $table->string('longitude', 50)->comment('Kinh độ của địa điểm công ty');
            $table->string('radius', 50)->comment('Bán kính hợp lệ cho địa điểm công ty (tính bằng mét)');
            $table->boolean('is_active')->default(true)->comment('Trạng thái hoạt động của địa điểm công ty');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_locations');
    }
};
