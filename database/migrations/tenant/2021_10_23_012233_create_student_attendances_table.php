<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_attendances', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('class_teacher');
            $table->unsignedBigInteger('grade_id');
            $table->unsignedBigInteger('attendance_date');
            $table->timestamps();
            
            $table->foreign('student_id')->references('id')->on('users');
            $table->foreign('class_teacher')->references('id')->on('users');
            $table->foreign('grade_id')->references('id')->on('grades');
        
          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_attendances');
    }
}
