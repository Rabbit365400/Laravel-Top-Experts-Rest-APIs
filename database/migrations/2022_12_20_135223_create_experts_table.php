<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experts', function (Blueprint $table) {
            $table->id();
            $table->string('fname');
            $table->string('lname');
            $table->string('pnumber');
            $table->string('email');
            $table->string('email_verified')->nullable();
            $table->string('photo')->nullable();
            $table->string('business_name')->nullable();
            $table->string('area_of_expertise')->nullable();
            $table->string('years_of_experience')->nullable();
            $table->string('location')->nullable();
            $table->string('licensed')->nullable();
            $table->string('town')->nullable();
            $table->string('county')->nullable();
            $table->string('country')->nullable();
            $table->string('no_of_employees')->nullable();
            $table->string('number_of_customers')->nullable();
            $table->string('description')->nullable();
            $table->string('website')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('business_pnumber')->nullable();
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
        Schema::dropIfExists('experts');
    }
};
