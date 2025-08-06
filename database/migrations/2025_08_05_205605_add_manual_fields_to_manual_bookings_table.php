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
    Schema::table('manual_bookings', function (Blueprint $table) {
        $table->string('nama_manual')->nullable();
        $table->string('telepon_manual')->nullable();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    Schema::table('manual_bookings', function (Blueprint $table) {
        $table->dropColumn(['nama_manual', 'telepon_manual']);
    });
    }
};
