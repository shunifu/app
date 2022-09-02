<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStreamSubjectAveragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stream_subject_averages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stream_id');
            $table->unsignedBigInteger('term_id');
            $table->unsignedBigInteger('subject_id');
            $table->integer('subject_average');
            $table->timestamps();
            $table->foreign('stream_id')->references('id')->on('streams');
            $table->foreign('term_id')->references('id')->on('terms');
            $table->foreign('subject_id')->references('id')->on('subjects');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stream_subject_averages');
    }
}
