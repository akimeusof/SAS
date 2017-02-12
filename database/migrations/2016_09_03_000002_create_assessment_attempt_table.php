<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssessmentAttemptTable extends Migration
{
    public function up()
    {
        Schema::create('assessmentattempts', function (Blueprint $table) {
            $table->increments('assessmentattempt_id');
            $table->integer('user_id')->unsigned();
            $table->integer('assessment_id')->unsigned();
            $table->integer('status')->default(0);
            $table->float('totalmarks')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('assessment_id')->references('assessment_id')->on('assessments');
        });
    }

    public function down()
    {
        Schema::drop('assessmentattempts');
    }
}
