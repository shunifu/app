<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTiesColumnAndTermAverageNumberTypeColumToPassRates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pass_rates', function (Blueprint $table) {
            $table->string('tie_type');
            $table->string('term_average_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pass_rates', function (Blueprint $table) {
            //
        });
    }
}
