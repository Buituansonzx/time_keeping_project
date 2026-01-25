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
        Schema::create('salary_contracts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->comment('ID của người dùng');
            $table->enum('salary_type', ['monthly', 'hourly', 'daily'])->comment('Loại lương (theo tháng, theo giờ, theo ngày)');
            $table->bigInteger('base_salary')->unsigned()->comment('Mức lương cơ bản');
            $table->date('effective_from')->comment('Ngày bắt đầu hợp đồng lương');
            $table->date('effective_to')->nullable()->comment('Ngày kết thúc hợp đồng lương (nếu có)');
            $table->string('notes', 500)->nullable()->comment('Ghi chú bổ sung về hợp đồng lương');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary_contracts');
    }
};
