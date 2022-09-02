<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('student_class');
            $table->unsignedBigInteger('student_stream');
            $table->unsignedBigInteger('student_section');
            $table->integer('student_average');
            $table->unsignedBigInteger('term_id');
            $table->integer('number_of_passed_subjects');
            $table->integer('passing_subject_status');
            $table->timestamps();
            $table->foreign('student_id')->references('id')->on('users');
            $table->foreign('student_class')->references('id')->on('grades');
            $table->foreign('student_stream')->references('id')->on('streams');
            $table->foreign('student_section')->references('id')->on('sections');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
