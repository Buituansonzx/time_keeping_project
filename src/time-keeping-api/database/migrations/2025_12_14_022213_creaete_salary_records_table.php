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
        Schema::create('salary_records', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->comment('ID of the user');
            $table->bigInteger('salary_cycle_id')->unsigned()->comment('ID of the salary cycle');
            $table->decimal('total_work_days')->default(0)-> comment('Total number of work days in the salary cycle');
            $table->decimal('total_work_hours')->default(0)-> comment('Total number of work hours in the salary cycle');
            $table->bigInteger('base_salary')->unsigned()->comment('Base salary for the user in this cycle');
            $table->bigInteger('bonus_amount')->unsigned()->default(0)->comment('Total bonuses for the user in this cycle');
            $table->bigInteger('penalty_amount')->unsigned()->default(0)->comment('Total penalties for the user in this cycle');
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
        Schema::dropIfExists('salary_records');
    }
};
