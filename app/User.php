<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'password', 'type', 'status'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    //validation rules when public user wants to login
    public static $loginValidationRules = [
        'username' => 'required|exists:users|min:4|max:32',
        'password' => 'required|min:4|max:60'
        ];

    //validation rules for admin to insert new admin
    //start//
    public static $insertAdminValidationRules = [
        'username' => 'required|min:4|max:32|unique:users',
        'id' => 'required|min:6|max:12|unique:adminprofiles',
        'name' => 'required',
        'email' => 'required|email|unique:adminprofiles',
    ];
    
    public static $adminCreateClassroomValidationRules = [
        'subject' => 'required',
        'lecturer' => 'required',
        'enrollmentkey' => 'required|min:8',
        'section' => 'required'
    ];
    //end//
    public function AdminProfile(){
        return $this->hasOne('App\AdminProfile');
    }
    public function LecturerProfile(){
        return $this->hasOne('App\LecturerProfile');
    }
    public function StudentProfile(){
        return $this->hasOne('App\StudentProfile');
    }

    public function subjects()
    {
        return $this->belongsToMany('App\Subject', 'classrooms', 'user_id', 'subject_id')->withPivot(array(
                                    'classroom_id', 'user_id', 'subject_id', 'semester_id', 'enrollmentkey', 'section', 'capacity', 'status'));
    }
    
    public function enrollments()
    {
        return $this->hasMany('App\Enrollment');
    }

    public function classrooms()
    {
        return $this->hasMany('App\Classroom');
    }
    
}
