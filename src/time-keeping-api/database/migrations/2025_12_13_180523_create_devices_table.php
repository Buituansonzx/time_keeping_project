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
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->comment('ID of the user owning the device');
            $table->string('device_fingerprint', 255)->unique()->comment('Unique fingerprint of the device');
            $table->enum('device_type', ['web', 'ios', 'android'])->comment('Type of the device (web, ios, android)');
            $table->boolean('is_primary')->default(false)->comment('Indicates if this is the primary device for the user');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
