<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
         // Tambahkan nilai enum 'lain'
        DB::statement("ALTER TABLE products MODIFY kategori ENUM('gedung', 'rumah_dinas', 'lain') NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         // Hapus nilai enum 'lain'
        DB::statement("ALTER TABLE products MODIFY kategori ENUM('gedung', 'rumah_dinas') NOT NULL");
    }
};
