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
        Schema::table('form_groups', function (Blueprint $table) {
            $table->string('academic_year')->after('description')->nullable()->comment('Academic year of the form, e.g., 2024/2025');
            $table->string('category')->after('academic_year')->nullable()->comment('Category of the form, e.g., Zoning, Achievement, Affirmation');
        });
    }
    
    public function down()
    {
        Schema::table('form_groups', function (Blueprint $table) {
            $table->dropColumn(['academic_year', 'category']);
        });
    }
};
