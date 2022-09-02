<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSchoolLogoColumnToSchoolInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('school_info', function (Blueprint $table) {
            $table->string('school_logo');
            $table->string('school_letter_head');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('school_info', function (Blueprint $table) {
            $table->dropColumn('school_logo');
            $table->dropColumn('school_letterhead');

        });
    }
}
