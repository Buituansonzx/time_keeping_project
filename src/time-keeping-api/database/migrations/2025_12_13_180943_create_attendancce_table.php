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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->comment('ID của người dùng');
            $table->bigInteger('device_id')->unsigned()->comment('ID của thiết bị được sử dụng để chấm công');
            $table->timestamp('check_in_time')->comment('Thời gian chấm công');
            $table->timestamp('check_out_time')->nullable()->comment('Thời gian chấm công ra (nếu có)');
            $table->enum( 'status', ['valid', 'manual'])->default('valid')->comment('Trạng thái chấm công: valid - chấm công tự động, manual - chấm công thủ công');
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
        Schema::dropIfExists('attendances');
    }
};
