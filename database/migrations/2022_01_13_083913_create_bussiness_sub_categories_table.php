<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBussinessSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bussiness_sub_categories', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('subcategoryname');
            $table->string('slug');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('featured_image')->nullable(); 
            $table->string('category_name');
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
        Schema::dropIfExists('bussiness_sub_categories');
    }
}
