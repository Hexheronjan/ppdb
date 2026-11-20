<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('angkatan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_angkatan');           // e.g. "Al-Fatih"
            $table->string('tahun_ajaran');             // e.g. "2025/2026"
            $table->date('tanggal_mulai_daftar');       // tanggal buka pendaftaran
            $table->date('tanggal_tutup_daftar');       // tanggal tutup pendaftaran
            $table->boolean('is_active')->default(true);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('angkatan');
    }
};
