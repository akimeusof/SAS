<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $primaryKey = 'enrollment_id';
    protected $table = 'enrollments';
    protected $fillable = ['user_id', 'classroom_id', 'status'];


    //pakai untuk class and assessments
    //start..
    public function classroom(){
        return $this->belongsTo('App\Classroom');
    }
    public function studentProfile(){
        return $this->belongsTo('App\StudentProfile', 'user_id', 'user_id');
    }
    //end..


    public function user(){
        return $this->belongsTo('App\User');
    }
}
