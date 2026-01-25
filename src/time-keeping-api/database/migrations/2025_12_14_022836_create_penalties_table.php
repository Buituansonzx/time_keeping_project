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
        Schema::create('penalties', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->comment('ID of the user receiving the penalty');
            $table->bigInteger('salary_cycle_id')->unsigned()->comment('ID of the salary cycle associated with the penalty');
            $table->string('name', 255)->comment('Tên hình phạt');
            $table->text('description')->nullable()->comment('Mô tả chi tiết về hình phạt');
            $table->decimal('amount', 10, 2)->comment('Số tiền phạt áp dụng');
            $table->dateTime('applied_at')->comment('Thời gian áp dụng hình phạt');
            $table->bigInteger('approved_by')->unsigned()->nullable()->comment('ID của người phê duyệt hình phạt');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('salary_cycle_id')->references('id')->on('salary_cycles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penalties');
    }
};
