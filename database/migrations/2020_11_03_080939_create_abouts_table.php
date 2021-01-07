<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('heading')->nullable();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->string('section1_heading')->nullable();
            $table->text('section1_description')->nullable();
            $table->string('section2_heading')->nullable();
            $table->text('section2_description')->nullable();
            $table->string('section3_image')->nullable();
            $table->string('section3_heading')->nullable();
            $table->text('section3_description')->nullable();
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
        Schema::dropIfExists('abouts');
    }
}
