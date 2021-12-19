<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('name')->unique();
            $table->integer('featured_business')->default(1);
            $table->text('description');
            $table->string('slug');
            $table->string('andress')->nullable();;
            $table->string('website')->nullable();;
            $table->string('email')->nullable();;
            $table->string('contact')->nullable();;
            $table->string('categoryName')->nullable();;
            $table->string('subcategoryName')->nullable();;
            $table->string('country')->nullable();;
            $table->string('code')->nullable();;
            $table->string('zipcode')->nullable();;
            $table->string('fax')->nullable();;
            $table->string('city')->nullable();;
            $table->string('image')->default('noLogo.png');
            $table->string('featured_image')->default('no_featuredImage.jpg');
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
        Schema::dropIfExists('business');
    }
}
