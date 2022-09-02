<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAssessementTypeColumnToSubjectAveragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subject_averages', function (Blueprint $table) {
            $table->integer('assessement_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subject_averages', function (Blueprint $table) {
            $table->dropColumn('assessement_type');
        });
    }
}
