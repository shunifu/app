<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarkReadingSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mark_reading_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('section_id');
            $table->integer('passing_rate');
            $table->integer('number_of_subjects');
            $table->integer('passing_subject_rule');
            $table->string('average_calculation');
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
        Schema::dropIfExists('mark_reading_settings');
    }
}
