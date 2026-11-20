<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('angkatan', function (Blueprint $table) {
            $table->time('jam_mulai_daftar')->nullable()->after('tanggal_mulai_daftar');
            $table->time('jam_tutup_daftar')->nullable()->after('tanggal_tutup_daftar');
        });
    }

    public function down(): void
    {
        Schema::table('angkatan', function (Blueprint $table) {
            $table->dropColumn(['jam_mulai_daftar', 'jam_tutup_daftar']);
        });
    }
};
