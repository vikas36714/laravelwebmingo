<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('vendor_id')->unique()->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('business_type')->nullable();
            $table->string('website')->nullable();
            $table->string('referral_id')->nullable();
            $table->text('full_address')->nullable();
            $table->string('pan_card_number')->nullable();
            $table->string('aadhaar_card_number')->nullable();
            $table->string('business_proof_number')->nullable();
            $table->string('business_address')->nullable();
            $table->string('account_type')->nullable();
            $table->string('account_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('ifsc_code')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_branch')->nullable();
            $table->string('pan_card_document')->nullable();
            $table->string('aadhaar_card_front')->nullable();
            $table->string('aadhaar_card_back')->nullable();
            $table->string('business_proof_document')->nullable();
            $table->string('cancelled_cheque_img')->nullable();
            $table->string('photographs')->nullable();
            $table->string('other_documents')->nullable();
            $table->string('email');
            $table->string('mobile_number');
            $table->string('password');
            $table->string('country_id')->nullable();
            $table->string('state_id')->nullable();
            $table->string('city_id')->nullable();
            $table->string('category_id')->nullable();
            $table->string('sub_category_id')->nullable();
            $table->string('service_id')->nullable();
            $table->string('city_id')->nullable();
            $table->string('profile_pic')->nullable();
            $table->enum('role', ['user','vender','admin'])->default('user');;
            $table->string('gender')->nullable();
            $table->string('pincode')->nullable();
            $table->text('address')->nullable();
            $table->string('landmark')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->text('profile_photo_path')->nullable();
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
        Schema::dropIfExists('users');
    }
}
