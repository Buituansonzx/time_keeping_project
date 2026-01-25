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
         Schema::table('users', function (Blueprint $table){
            $table->string('phone_number')->nullable()->after('email')->comment('Số điện thoại của người dùng');
            $table->integer('status')->default(1)->after('phone_number')->comment('Trạng thái của người dùng: 1 - Hoạt động, 0 - Không hoạt động');
         });
         Schema::table('roles', function (Blueprint $table){
            $table->dropColumn('code');
         } );

         Schema::table('permissions', function (Blueprint $table){
            $table->dropColumn('code');
         } );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table){
            $table->dropColumn('phone_number');
            $table->dropColumn('status');
         });
        Schema::table('roles', function (Blueprint $table){
                $table->string('code')->nullable()->unique()->after('id');
        } );
        Schema::table('permissions', function (Blueprint $table){
                $table->string('code')->nullable()->unique()->after('id');
        } );
    }
};
