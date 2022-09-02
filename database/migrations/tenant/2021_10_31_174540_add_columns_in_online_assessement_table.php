<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsInOnlineAssessementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assessement_onlines', function (Blueprint $table) {
            $table->string('subject_id')->nullable();
            $table->string('class_id')->nullable();
            $table->string('assessement_title')->nullable();
            $table->string('assessement_type');
            $table->string('timed_status');
            $table->dateTime('timed_from')->nullable();
            $table->dateTime('timed_to')->nullable();
            $table->string('lesson_topic')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assessement_onlines', function (Blueprint $table) {
           // Schema::dropIfExists('assessement_onlines');
        });
    }
}
