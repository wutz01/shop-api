<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('firstname');
            $table->string('middlename');
            $table->string('lastname');
            $table->text('address');
            $table->string('city');
            $table->string('zipCode');
            $table->string('mobileNo');
            $table->string('phoneNo');
            $table->string('country');
            $table->string('companyName')->nullable();
            $table->string('companyEmail')->nullable();
            $table->string('lineBusiness')->nullable();
            $table->string('companyAddress')->nullable();
            $table->string('companyCity')->nullable();
            $table->string('companyZipCode')->nullable();
            $table->string('companyLandLine')->nullable();
            $table->string('companyCountry')->nullable();
            $table->string('designation')->nullable(); // Type of Company: Government / Private
            $table->string('userType'); // ADMIN / CLIENT / SALES_AGENT
            $table->rememberToken();
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
