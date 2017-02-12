<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    protected $primaryKey = 'classroom_id';
    protected $table = 'classrooms';
    protected $fillable = ['user_id', 'subject_id', 'semester_id', 'enrollmentkey', 'section', 'capacity', 'status'];

    //untuk lecture nak tgk assessments
    public function subject()
    {
        return $this->belongsTo('App\Subject');
    }

    public function lecturerProfile()
    {
        return $this->belongsTo('App\LecturerProfile', 'user_id', 'user_id');
    }

    //untuk lecturer nak relate dgn exam paper
    public function assessments()
    {
        return $this->hasMany('App\Assessment');
    }
    //classroom relate to student enrollments
    public function enrollments()
    {
        return $this->hasMany('App\Enrollment');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function semester()
    {
        return $this->belongsTo('App\Semester');
    }
}
