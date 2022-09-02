<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssessementProgressReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessement_progress_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('assessement_id');
            $table->integer('assessement_type');
            $table->unsignedBigInteger('student_id');
        
            $table->unsignedBigInteger('student_class');
            $table->unsignedBigInteger('student_stream');
            $table->unsignedBigInteger('student_section');
            $table->integer('student_average');
            $table->unsignedBigInteger('term_id');
            $table->integer('number_of_passed_subjects');
            $table->integer('passing_subject_status');
            $table->timestamps();

            $table->foreign('assessement_id')->references('id')->on('assessements');
            $table->foreign('student_id')->references('id')->on('users');
            // $table->foreign('student_class')->references('id')->on('grades');
            // $table->foreign('student_stream')->references('id')->on('streams');
            // $table->foreign('term_id')->references('id')->on('terms');
            // $table->foreign('student_section')->references('id')->on('sections');
           

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assessement_progress_reports');
    }
}
