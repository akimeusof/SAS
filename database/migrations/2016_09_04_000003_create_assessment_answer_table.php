<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssessmentAnswerTable extends Migration
{
    public function up()
    {
        Schema::create('assessmentanswers', function (Blueprint $table) {
            $table->increments('assessmentanswer_id');
            $table->integer('assessmentattempt_id')->unsigned();
            $table->integer('assessmentquestion_id')->unsigned();
            $table->longText('s_answer')->nullable();
            $table->float('marks')->nullable();
            $table->timestamps();

            $table->foreign('assessmentattempt_id')->references('assessmentattempt_id')->on('assessmentattempts');
            $table->foreign('assessmentquestion_id')->references('assessmentquestion_id')->on('assessmentquestions');
        });
    }

    public function down()
    {
        Schema::drop('assessmentanswers');
    }
}
