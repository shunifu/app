<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssessementWeightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessement_weights', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('term_id');
            $table->integer('ca_percentage');
            $table->integer('exam_percentage');
            $table->timestamps();
            $table->foreign('term_id')->references('id')->on('terms');
          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assessement_weights');
    }
}
