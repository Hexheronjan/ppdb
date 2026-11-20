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
        Schema::create('form_groups', function (Blueprint $table) {
            $table->id('id_form'); // Primary Key
            $table->string('name'); // Nama formulir, contoh: "Pendaftaran Jalur Prestasi"
            $table->text('description')->nullable(); // Deskripsi formulir
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('form_groups');
    }


};
