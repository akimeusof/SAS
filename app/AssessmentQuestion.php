<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssessmentQuestion extends Model
{
    protected $primaryKey = 'assessmentquestion_id';
    protected $table = 'assessmentquestions';
    protected $fillable = ['assessment_id', 'question_id', 'marks', 'status'];

    public function question()
    {
        return $this->belongsTo('App\Question', 'question_id', 'question_id');
    }
    public function assessment()
    {
        return $this->belongsTo('App\Assessment', 'assessment_id', 'assessment_id');
    }
    
    public function assessmentAnswers()
    {
        return $this->hasMany('App\AssessmentAnswer');
    }
}
