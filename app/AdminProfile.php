<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminProfile extends Model
{
    protected $primaryKey = "adminprofile_id";
    protected $table = 'adminprofiles';
    protected $fillable = ['user_id', 'id', 'name', 'email', 'avatar', 'address', 'phonenumber', 'homenumber'];
    protected $hidden = ['password', 'remember_token'];

    //to make relation with user model/for joining profile with users table
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
