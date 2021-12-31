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
            $table->string('slug');
            $table->string('country');
            $table->string('city');
            $table->string('company');
            $table->string('companyWebsite')->nullable();
            $table->string('email');
            $table->string('phone');
            $table->string('zipcode');
            $table->string('address');
            $table->string('jobType');
            $table->string('companyAbbreviation')->nullable();
            $table->string('position_1')->nullable();
            $table->string('position_2')->nullable();
            $table->string('position_3')->nullable();
            $table->string('skills');
            $table->string('responsibility');
            $table->integer('jobPositions');
            $table->string('description');
            $table->string('companyLogo')->default('company/no_featuredImage.jpg');
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
