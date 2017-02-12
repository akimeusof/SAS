<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';
    protected $primaryKey = 'question_id';
    protected $fillable = ['subject_id', 'user_id', 'diagram', 'question', 'answer', 'chapter_no', 'status', 'use_type'];
    //use_type tu untuk nak bezakan soalan public 0 or private 1 owner 2

    public function subject()
    {
        return $this->belongsTo('App\Subject');
    }

    public function chapter()
    {
        return $this->belongsTo('App\SubjectChapter', 'chapter_no', 'chapter_no');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function AssessmentQuestions()
    {
        return $this->hasMany('App\AssessmentQuestion', 'question_id', 'question_id');
    }

    public static $addNewQuestionValidationRules = [
//        'subject' => 'required',
//        'section' => 'required',
//        'enrollmentkey' => 'required|min:8'
    ];
}
