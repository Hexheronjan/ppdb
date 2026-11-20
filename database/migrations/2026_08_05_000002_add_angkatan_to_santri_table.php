<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('santri', function (Blueprint $table) {
            $table->string('tahun_ajaran')->nullable()->after('status');
            $table->foreignId('angkatan_id')->nullable()->after('tahun_ajaran')
                  ->constrained('angkatan')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('santri', function (Blueprint $table) {
            $table->dropForeign(['angkatan_id']);
            $table->dropColumn(['tahun_ajaran', 'angkatan_id']);
        });
    }
};
