<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_comments', function (Blueprint $table) {
            $table->id();
            $table->integer('teacher_id');
            $table->integer('teaching_load_id');
            $table->longText('comment');
            $table->integer('report_type');
            $table->integer('cycle_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('custom_comments');
    }
};
