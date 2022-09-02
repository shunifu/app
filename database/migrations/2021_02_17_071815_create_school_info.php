<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_info', function (Blueprint $table) {
            $table->id();
            $table->string('school_code')->unique();
            $table->string('school_domain')->unique();
            $table->string('school_name');
            $table->string('school_slogan')->unique();
            $table->string('school_description')->nullable();
            $table->enum('school_type', ['primary-school', 'secondary-school', 'high-school', 'college']);
            $table->string('school_physical_location')->nullable();
            $table->integer('school_gps')->nullable();
            $table->string('school_email')->nullable()->unique();
            $table->integer('school_telephone')->unique();
            $table->string('school_website')->nullable();
            $table->string('school_postal_address')->nullable();
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
        Schema::dropIfExists('school_info');
    }
}
