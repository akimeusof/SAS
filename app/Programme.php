<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
    protected $table = 'programmes';
    protected $primaryKey = 'programme_id';
    protected $fillable = ['name', 'status'];

    public function StudentProfile()
    {
        return $this->hasMany('App\StudentProfile', 'programme', 'programme_id');
    }
}
