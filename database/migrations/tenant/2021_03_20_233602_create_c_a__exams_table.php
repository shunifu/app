repor<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCAExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_a__exams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('assessement_id');
            $table->unsignedBigInteger('term_id');
            $table->string('assign_as');
            $table->timestamps();
            $table->foreign('term_id')->references('id')->on('terms');
            $table->foreign('assessement_id')->references('id')->on('assessements');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('c_a__exams');
    }
}
