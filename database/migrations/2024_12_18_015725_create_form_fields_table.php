<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('form_fields', function (Blueprint $table) {
            $table->id('id_field');
            $table->unsignedBigInteger('id_form'); // Foreign key ke form_groups
            $table->string('name'); // Nama unik untuk field
            $table->string('type'); // Jenis input: text, textarea, select, checkbox, etc.
            $table->string('label'); // Label input
            $table->string('placeholder')->nullable(); // Placeholder input
            $table->text('options')->nullable(); // Untuk 'select', 'radio', 'checkbox'
            $table->boolean('required')->default(false); // Apakah wajib diisi
            $table->timestamps();

            $table->foreign('id_form')->references('id_form')->on('form_groups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
          Schema::table('form_fields', function (Blueprint $table) {
            $table->dropForeign(['id_form']); // Hapus foreign key constraint
            $table->dropColumn('id_form'); // Hapus kolom form_id
        });
    }
};
