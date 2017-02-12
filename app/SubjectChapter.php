<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubjectChapter extends Model
{
    protected $primaryKey = "subjectchapter_id";
    protected $table = 'subjectchapters';
    protected $fillable = ['subject_id', 'chapter_no', 'chapter_name'];
    
    public function subject()
    {
        return $this->belongsTo('App\Subject');
    }

}
