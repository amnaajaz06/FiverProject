<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('profile_picture');
            $table->string('location');
            $table->string('seller_description');
            $table->string('street_address');
            $table->string('unit_number');
            $table->string('city');
            $table->string('state');
            $table->integer('zip_code');
            $table->date('birthdate');
            $table->string('about_us');
            $table->timestamps();
 
            $table->integer('user_id')->unsigned()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sellers');
    }
}
