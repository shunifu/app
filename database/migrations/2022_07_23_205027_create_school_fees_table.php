<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_fees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('account_id');
            $table->decimal('amount', $precision = 10, $scale = 3);
            $table->unsignedBigInteger('stream_id');
            $table->string('school_fees_type');
            $table->unsignedBigInteger('session_id');

            $table->foreign('account_id')->references('id')->on('accounts');
            $table->foreign('stream_id')->references('id')->on('streams');
            $table->foreign('session_id')->references('id')->on('academic_sessions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('school_fees');
    }
}
