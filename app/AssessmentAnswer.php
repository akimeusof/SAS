<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssessmentAnswer extends Model
{
    protected $table = 'assessmentanswers';
    protected $primaryKey = 'assessmentanswer_id';
    protected $fillable = ['assessmentattempt_id', 'assessmentquestion_id', 's_answer', 'marks'];

    public function assessmentQuestion(){
        return $this->belongsTo('App\AssessmentQuestion', 'assessmentquestion_id', 'assessmentquestion_id');
    }
    public function AssessmentAttempt(){
        return $this->belongsTo('App\AssessmentAttempt', 'assessmentattempt_id', 'assessmentattempt_id');
    }

}
