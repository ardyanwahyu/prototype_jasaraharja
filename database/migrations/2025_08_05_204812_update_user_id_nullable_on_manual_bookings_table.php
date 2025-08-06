<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyUserIdOnManualBookingsTable extends Migration
{
    public function up()
    {
        Schema::table('manual_bookings', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->change(); // 👈 pastikan nullable
        });
    }

    public function down()
    {
        Schema::table('manual_bookings', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable(false)->change();
        });
    }
}
