<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectAveragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_averages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('teaching_load_id');
            $table->integer('student_average');
            $table->integer('subject_status');
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('student_class');
            $table->unsignedBigInteger('student_stream');
            $table->unsignedBigInteger('student_section');
            $table->unsignedBigInteger('term_id');
            $table->timestamps();
            
            $table->foreign('student_id')->references('id')->on('users');
            $table->foreign('teaching_load_id')->references('id')->on('teaching_loads');
            $table->foreign('subject_id')->references('id')->on('subjects');
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
        Schema::dropIfExists('subject_averages');
    }
}
