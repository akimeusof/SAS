<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionTable extends Migration
{
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('question_id');
            $table->integer('subject_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('diagram')->nullable();
            $table->longText('question');
            $table->longText('answer');
            $table->integer('chapter_no')->unsigned();
            $table->integer('use_type')->default(0);
            $table->integer('status')->default(0);
            $table->timestamps();

            $table->foreign('subject_id')->references('subject_id')->on('subjects');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('chapter_no')->references('chapter_no')->on('subjectchapters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('questions');
    }
}
