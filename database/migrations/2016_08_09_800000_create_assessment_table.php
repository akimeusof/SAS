<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssessmentTable extends Migration
{
    public function up()
    {
        Schema::create('assessments', function (Blueprint $table) {
            $table->increments('assessment_id');
            $table->integer('classroom_id')->unsigned();
            $table->string('assessmentname');
            $table->integer('assessmentmarks');
            $table->integer('numberofquestion');
//            $table->integer('chapter');
            $table->integer('duration');
            $table->string('start');
            $table->string('end');
            $table->string('remarks')->nullable();
            $table->integer('status')->default(0);
            $table->integer('revealmarks')->default(0);
            $table->timestamps();

            $table->foreign('classroom_id')->references('classroom_id')->on('classrooms');
        });
    }

    public function down()
    {
        Schema::drop('assessments');
    }
}
