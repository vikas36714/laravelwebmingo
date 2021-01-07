<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_loans', function (Blueprint $table) {
            $table->id();
            $table->string('loan_id')->unique();
            $table->string('vendor_id');
            $table->string('loan_amount');
            $table->string('loan_remaining')->nullable();
            $table->string('deduction')->nullable();
            $table->text('loan_details')->nullable();
            $table->enum('status', ['pending', 'active', 'completed']);
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
        Schema::dropIfExists('vendor_loans');
    }
}
