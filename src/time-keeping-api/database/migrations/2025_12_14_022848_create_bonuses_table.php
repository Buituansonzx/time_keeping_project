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
        Schema::create('bonuses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->comment('ID của người nhận khoản thưởng');
            $table->bigInteger('salary_cycle_id')->unsigned()->comment('ID của chu kỳ lương liên quan đến khoản thưởng');
            $table->string('name', 255)->comment('Tên khoản thưởng');
            $table->text('description')->nullable()->comment('Mô tả chi tiết về khoản thưởng');
            $table->decimal('amount', 10, 2)->comment('Số tiền thưởng áp dụng');
            $table->dateTime('applied_at')->comment('Thời gian áp dụng khoản thưởng');
            $table->bigInteger('approved_by')->unsigned()->nullable()->comment('ID của người phê duyệt khoản thưởng');
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
        Schema::dropIfExists('bonuses');
    }
};
