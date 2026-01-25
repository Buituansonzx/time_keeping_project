<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attendance', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->comment('ID của người dùng');
            $table->bigInteger('device_id')->unsigned()->comment('ID của thiết bị được sử dụng để chấm công');
            $table->timestamp('check_in_time')->comment('Thời gian chấm công');
            $table->timestamp('check_out_time')->nullable()->comment('Thời gian chấm công ra (nếu có)');
            $table->string('ip_address', 45)->comment('Địa chỉ IP từ nơi chấm công');
            $table->string('atd_lat')->comment('Vĩ độ tại thời điểm chấm công');
            $table->string('atd_long')->comment('Kinh độ tại thời điểm chấm công');
            $table->enum('network_status', ['external', 'internal'])->comment('Trạng thái mạng khi chấm công (bên ngoài hoặc bên trong)');
            $table->enum('gps_status', ['in_range', 'out_of_range'])->comment('Trạng thái GPS khi chấm công (trong phạm vi hoặc ngoài phạm vi)');
            $table->enum('attendance_status', ['valid', 'suspicious', 'reject'])->comment('Trạng thái chấm công (hợp lệ, đáng ngờ hoặc từ chối)');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('device_id')->references('id')->on('devices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance');
    }
};
