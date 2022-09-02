<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTermAveragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('term_averages', function (Blueprint $table) {
            $table->id();
            
            $table->integer('ca_student_average');
        
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('student_class');
            $table->unsignedBigInteger('student_stream');
            $table->unsignedBigInteger('student_section');

            $table->unsignedBigInteger('term_id');
            $table->integer('number_of_passed_subjects')->nullable();
            $table->integer('passing_subject_status')->nullable();
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
        Schema::dropIfExists('term_averages');
    }
}
