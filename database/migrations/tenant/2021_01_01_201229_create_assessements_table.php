<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssessementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessements', function (Blueprint $table) {
            $table->id();
            $table->string('assessement_name');
            $table->unsignedBigInteger('term_id');
            $table->unsignedBigInteger('assessement_type');
            $table->timestamps();
            $table->foreign('term_id')->references('id')->on('terms')->onDelete('cascade');
            $table->foreign('assessement_type')->references('id')->on('assessement_types')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assessements');
    }
}
