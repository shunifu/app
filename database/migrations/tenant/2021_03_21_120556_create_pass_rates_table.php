<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePassRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pass_rates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('section_id');
            $table->integer('passing_rate');
            $table->integer('number_of_subjects');
            $table->integer('passing_subject_rule');
            $table->timestamps();
            $table->foreign('section_id')->references('id')->on('sections');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pass_rates');
    }
}
