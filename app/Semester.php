<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Semester extends Model
{
    protected $table = 'semesters';
    protected $primaryKey = 'semester_id';
    protected $fillable = ['semester', 'start', 'end', 'status'];
    
    //carbon date format
    protected $dates = ['start', 'end'];

    //use CARBON to get current time
    public function scopeCurrent($query)
    {
        $currentTime = Carbon::now();
        return $query->where('start', '<=', $currentTime)->where('end', '>=', $currentTime);
    }

    public function classrooms()
    {
        return $this->hasMany('App\Classroom');
    }

}
