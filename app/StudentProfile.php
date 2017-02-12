<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentProfile extends Model
{
    protected $primaryKey = "studentprofile_id";
    protected $table = 'studentprofiles';
    protected $fillable = ['user_id', 'id', 'name', 'email', 'avatar', 'programme_id', 'address', 'phonenumber', 'homenumber'];
    protected $hidden = ['password', 'remember_token'];

    //to make relation with user model/for joining profile with users table
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function programme()
    {
        return $this->belongsTo('App\Programme', 'programme_id', 'programme_id');
    }
    public function enrollments()
    {
        return $this->hasMany('App\Enrollment', 'user_id', 'user_id');
    }
}