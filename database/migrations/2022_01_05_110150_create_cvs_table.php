<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cvs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstName');
            $table->integer('user_id');
            $table->string('lastName');
            $table->string('about');
            $table->string('email');
            $table->string('address')->nullable();
            $table->string('phone');
            $table->string('slug') ->nullable();
            $table->string('pdf_file');
            $table->string('profession');
            $table->string('location') ->nullable();
            $table->string('zipcode') ->nullable();
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
        Schema::dropIfExists('cvs');
    }
}
