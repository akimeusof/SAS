<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $primaryKey = "subject_id";
    protected $table = 'subjects';
    protected $fillable = ['code', 'name', 'totalchapter','status'];
    
//    public function user()
//    {
//        return $this->belongsTo('User');
//    }
    public function user()
    {
        return $this->belongsToMany('App\User', 'classrooms', 'user_id', 'subject_id')->withPivot(array(
            'classroom_id', 'user_id', 'subject_id', 'semester_id', 'enrollmentkey', 'section', 'capacity', 'status'));
    }
    
    public function chapters()
    {
        return $this->hasMany('App\SubjectChapter');
    }

    public static $insertSubjectValidationRules =
        [
            'code' => 'required|unique:subjects',
            'name' => 'required'
        ];
}
