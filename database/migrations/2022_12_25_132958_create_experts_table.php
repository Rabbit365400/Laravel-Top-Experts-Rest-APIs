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
            $table->string('email_verified');
            $table->string('photo')->default('https://www.pngarts.com/files/11/Avatar-Transparent-Images.png');
            $table->string('business_name')->default('No Value');
            $table->string('area_of_expertise')->default('No Value');
            $table->string('years_of_experience')->default('No Value');
            $table->string('location')->default('No Value');
            $table->string('licensed')->default('No Value');
            $table->string('town')->default('No Value');
            $table->string('county')->default('No Value');
            $table->string('country')->default('No Value');
            $table->string('no_of_employees')->default('No Value');
            $table->string('number_of_customers')->default('No Value');
            $table->string('description')->default('No Value');
            $table->string('website')->default('No Value');
            $table->string('facebook')->default('No Value');
            $table->string('twitter')->default('No Value');
            $table->string('instagram')->default('No Value');
            $table->string('business_pnumber')->default('No Value');
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
