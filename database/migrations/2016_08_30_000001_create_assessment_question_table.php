<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssessmentQuestionTable extends Migration
{
    public function up()
    {
        Schema::create('assessmentquestions', function (Blueprint $table) {
            $table->increments('assessmentquestion_id');
            $table->integer('assessment_id')->unsigned();
            $table->integer('question_id')->unsigned();
            $table->integer('marks');
            $table->integer('status')->default(0);
            $table->timestamps();

            $table->foreign('assessment_id')->references('assessment_id')->on('assessments');
            $table->foreign('question_id')->references('question_id')->on('questions');
        });
    }

    public function down()
    {
        Schema::drop('assessmentquestions');
    }
}
