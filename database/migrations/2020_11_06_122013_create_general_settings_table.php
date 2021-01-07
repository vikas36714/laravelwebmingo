<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->string('header_setting_logo')->nullable();
            $table->string('footer_setting_logo')->nullable();
            $table->text('footer_setting_about_text')->nullable();
            $table->string('footer_setting_copyright')->nullable();
            $table->text('general_setting_address')->nullable();
            $table->string('general_setting_call_us')->nullable();
            $table->string('general_setting_email_us')->nullable();
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
        Schema::dropIfExists('general_settings');
    }
}
