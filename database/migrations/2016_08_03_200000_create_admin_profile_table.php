<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adminprofiles', function (Blueprint $table) {
            $table->increments('adminprofile_id');
            $table->integer('user_id')->unsigned();
            $table->string('id', 10);
            $table->string('name');
            $table->string('email')->unique();
            $table->string('avatar')->default('default.jpg');
            $table->string('address')->nullable();
            $table->string('phonenumber')->nullable();
            $table->string('homenumber')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('users');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('adminprofiles');
    }
}
