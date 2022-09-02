<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLoadsCountInAssessementProgressReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assessement_progress_reports', function (Blueprint $table) {
            $table->integer('loads_count');
            $table->integer('marks_count');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assessement_progress_reports', function (Blueprint $table) {
            //
        });
    }
}
