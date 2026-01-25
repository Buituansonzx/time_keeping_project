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
        Schema::create('company_networks', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->comment('Tên mạng công ty');
            $table->string('ip_range_start', 45)->comment('Địa chỉ IP bắt đầu của phạm vi mạng công ty');
            $table->string('ip_range_end', 45)->comment('Địa chỉ IP kết thúc của phạm vi mạng công ty');
            $table->boolean('is_active')->default(true)->comment('Trạng thái hoạt động của mạng công ty');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_networks');
    }
};
