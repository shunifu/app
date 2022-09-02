<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_fees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->decimal('amount', $precision = 10, $scale = 3);
            $table->string('ref');
            $table->string('system_ref');
            $table->date('payment_date');
            $table->unsignedBigInteger('grade_id');
            $table->unsignedBigInteger('financial_year');
            $table->timestamps();
            $table->foreign('student_id')->references('id')->on('users');
            $table->foreign('grade_id')->references('id')->on('grades');
            $table->foreign('financial_year')->references('id')->on('academic_sessions');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_fees');
    }
}
