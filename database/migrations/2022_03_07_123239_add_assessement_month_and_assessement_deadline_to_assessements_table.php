<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAssessementMonthAndAssessementDeadlineToAssessementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assessements', function (Blueprint $table) {
            $table->dateTime('marks_deadline')->nullable();
            $table->string('assessement_month')->nullable();
            $table->dateTime('marks_extension')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assessements', function (Blueprint $table) {
            //
        });
    }
}
