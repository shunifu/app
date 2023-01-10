<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgressionStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progression_statuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('academic_session_id');
            $table->unsignedBigInteger('term_avg_id');
            $table->string('progression_status');
            $table->unsignedBigInteger('new_grade_id');
            $table->timestamps();
            $table->foreign('student_id')->references('id')->on('users');
            $table->foreign('academic_session_id')->references('id')->on('academic_sessions');
            $table->foreign('term_avg_id')->references('id')->on('term_averages');
            $table->foreign('new_grade_id')->references('id')->on('grades');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('progression_statuses');
    }
}
