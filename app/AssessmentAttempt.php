<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssessmentAttempt extends Model
{
    protected $table = 'assessmentattempts';
    protected $primaryKey = "assessmentattempt_id";
    protected $fillable = ['user_id', 'assessment_id', 'status', 'marks'];

    public function user(){
        return $this->belongsTo('App\User');
    }
    
    public function assessment(){
        return $this->belongsTo('App\Assessment');
    }
    
    public function AssessmentAnswers(){
        return $this->hasMany('App\AssessmentAnswer', 'assessmentattempt_id', 'assessmentattempt_id');
    }
    
    
}
