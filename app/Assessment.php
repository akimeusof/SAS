<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    protected $primaryKey = 'assessment_id';
    protected $table = 'assessments';
    protected $fillable = ['classroom_id', 'assessmentname', 'assessmentmarks', 'numberofquestion', 'duration', 'start', 'end', 'remarks', 'status', 'revealmarks'];

    public function Classroom()
    {
        return $this->belongsTo('App\Classroom');
//        return $this->hasOne('App\Classroom');
    }
}
