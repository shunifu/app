<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubjectAverageCalculationColumnToPassRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pass_rates', function (Blueprint $table) {
            $table->string('subject_average_calculation');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pass_rates', function (Blueprint $table) {
            $table->dropColumn('subject_average_calculation');
        });
    }
}
