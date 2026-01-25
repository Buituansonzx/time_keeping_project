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
        Schema::create('salary_cycles', function (Blueprint $table) {
            $table->id();
            $table->integer('month')->comment('Tháng của chu kỳ lương');
            $table->integer('year')->comment('Năm của chu kỳ lương');
            $table->date('start_date')->comment('Ngày bắt đầu chu kỳ lương');
            $table->date('end_date')->comment('Ngày kết thúc chu kỳ lương');
            $table->enum('status', ['open', 'locked', 'paid'])->default('open')->comment('Trạng thái của chu kỳ lương');
            $table->timestamp('locked_at')->nullable()->comment('Thời gian khóa chu kỳ lương để ngăn chỉnh sửa thêm');
            $table->bigInteger('locked_by')->unsigned()->nullable()->comment('ID của người dùng đã khóa chu kỳ lương');
            $table->timestamp('paid_at')->nullable()->comment('Thời gian chu kỳ lương được đánh dấu là đã trả');
            $table->string('notes', 500)->nullable()->comment('Ghi chú bổ sung về chu kỳ lương');
            $table->timestamps();

            $table->foreign('locked_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary_cycles');
    }
};
