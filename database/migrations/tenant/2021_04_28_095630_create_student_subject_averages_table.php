<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentSubjectAveragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_subject_averages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('teaching_load_id');
            $table->integer('ca_average')->nullable();
            $table->integer('exam_mark')->nullable();
            $table->integer('student_average');
            $table->unsignedBigInteger('student_class');
            $table->unsignedBigInteger('term_id');
            $table->string('student_key')->unique();
            $table->integer('position');
            $table->timestamps();
            
            $table->foreign('student_id')->references('id')->on('users');
            $table->foreign('teaching_load_id')->references('id')->on('teaching_loads');
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->foreign('student_class')->references('id')->on('grades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_subject_averages');
    }
}
