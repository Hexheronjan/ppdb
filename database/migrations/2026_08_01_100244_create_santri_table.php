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
        Schema::create('santri', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('jenis_kelamin');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('nisn', 10)->unique();
            $table->string('sekolah_asal');
            $table->string('nsm')->nullable();
            $table->string('npsn');
            $table->text('alamat_sekolah_asal');
            $table->string('program_pilihan');
            $table->string('info_ppdb');
            $table->enum('status', ['menunggu_verifikasi', 'diverifikasi', 'diterima', 'ditolak'])->default('menunggu_verifikasi');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('orang_tua_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('santri');
    }
};
