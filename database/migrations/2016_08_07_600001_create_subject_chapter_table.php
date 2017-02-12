<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectChapterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjectchapters', function (Blueprint $table) {
            $table->increments('subjectchapter_id');
            $table->integer('subject_id')->unsigned();
            $table->integer('chapter_no');
            $table->string('chapter_name');
            $table->timestamps();

            $table->foreign('subject_id')->references('subject_id')->on('subjects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('subjectchapters');
    }
}
