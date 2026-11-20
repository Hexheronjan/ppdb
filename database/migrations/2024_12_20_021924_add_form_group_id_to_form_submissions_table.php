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
        Schema::table('form_submissions', function (Blueprint $table) {
            $table->unsignedBigInteger('form_group_id')->nullable()->after('submission_id');
            $table->foreign('form_group_id')->references('id_form')->on('form_groups')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('form_submissions', function (Blueprint $table) {
            $table->dropForeign(['form_group_id']);
            $table->dropColumn('form_group_id');
        });
    }

};
