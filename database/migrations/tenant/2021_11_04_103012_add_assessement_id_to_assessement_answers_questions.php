<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAssessementIdToAssessementAnswersQuestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assessement_answers', function (Blueprint $table) {
            $table->unsignedBigInteger('assessement_id');
            $table->foreign('assessement_id')->references('id')->on('assessement_onlines');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assessement_answers', function (Blueprint $table) {
            //
        });
    }
}
