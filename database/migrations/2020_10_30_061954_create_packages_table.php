<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id');
            $table->foreignId('sub_category_id');
            $table->foreignId('sub_sub_category_id')->nullable();
            $table->foreignId('package_category_id')->nullable();
            $table->string('service_id')->nullable();
            $table->string('name');
            $table->string('video')->nullable();
            $table->string('amount')->nullable();
            $table->string('discount')->nullable();
            $table->string('after_discount')->nullable();
            $table->text('about_package')->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('packages');
    }
}
