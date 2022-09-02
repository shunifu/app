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
            $table->decimal('amount', 64, 0);
            $table->string('payment_reference');
            $table->string('system_ref');
            $table->date('payment_date');
            $table->unsignedBigInteger('fee_category_id');
            $table->unsignedBigInteger('session_id');
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('fee_category_id')->references('id')->on('fee_categories')->onDelete('cascade');
            $table->foreign('session_id')->references('id')->on('academic_sessions')->onDelete('cascade');

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
