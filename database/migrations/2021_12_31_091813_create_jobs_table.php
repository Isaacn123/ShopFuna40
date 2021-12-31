<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('user_id');
            $table->integer('salary');
            $table->slug('slug');
            $table->string('country');
            $table->string('city');
            $table->string('company');
            $table->string('companyWebsite');
            $table->string('email');
            $table->string('phone');
            $table->string('zipcode');
            $table->string('address');
            $table->string('jobType');
            $table->string('companyAbbreviation')->nullable();
            $table->integer('position_1')->nullable();
            $table->integer('position_2')->nullable();
            $table->integer('position_3')->nullable();
            $table->number('jobPositions');
            $table->string('description');
            $table->number('companyLogo');
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
        Schema::dropIfExists('jobs');
    }
}
