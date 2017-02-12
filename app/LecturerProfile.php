<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LecturerProfile extends Model
{
    protected $primaryKey = 'lecturerprofile_id';
    protected $table = 'lecturerprofiles';
    protected $fillable = ['user_id', 'id', 'name', 'email', 'avatar', 'address', 'phonenumber', 'homenumber'];
    protected $hidden = ['password', 'remember_token'];

    //to make relation with user model/for joining profile with users table
    public function user()
    {
        return $this->belongsTo('User');
    }
    
    public function subjects()
    {
        return $this->belongsToMany('App\Subject', 'classrooms', 'user_id', 'subject_id')->withPivot(array(
                                    'classroom_id', 'user_id', 'subject_id', 'semester_id', 'enrollmentkey', 'section', 'status'));
    }

    public static $createClassroomValidationRules = [
        'subject' => 'required',
        'section' => 'required',
        'enrollmentkey' => 'required|min:8'
    ];
}