<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdentifierColumnInAssessementReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assessement_progress_reports', function (Blueprint $table) {
            $table->integer('key');
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
            Schema::dropIfExists('assessement_progress_reports');
        });
    }
}
