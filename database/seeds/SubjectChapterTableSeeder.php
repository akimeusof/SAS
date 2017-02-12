<?php

use Illuminate\Database\Seeder;
use App\SubjectChapter;

class SubjectChapterTableSeeder extends Seeder
{
    public function run()
    {
        \DB::table('subjectchapters')->delete();
        //1
        SubjectChapter::create([
            'subject_id' => '5',
            'chapter_no' => 1,
            'chapter_name' => 'HTML',
        ]);
        
        //2
        SubjectChapter::create([
            'subject_id' => '5',
            'chapter_no' => 2,
            'chapter_name' => 'CSS',
        ]);
        
        //3
        SubjectChapter::create([
            'subject_id' => '5',
            'chapter_no' => 3,
            'chapter_name' => 'JAVASCRIPT',
        ]);
        
        //4
        SubjectChapter::create([
            'subject_id' => '5',
            'chapter_no' => 4,
            'chapter_name' => 'PHP',
        ]);
        
         //5
        SubjectChapter::create([
            'subject_id' => '5',
            'chapter_no' => 5,
            'chapter_name' => 'FORM',
        ]); 
        
        //6
        SubjectChapter::create([
            'subject_id' => '5',
            'chapter_no' => 6,
            'chapter_name' => 'DATABASE',
        ]);

        //7
        SubjectChapter::create([
            'subject_id' => '1',
            'chapter_no' => 6,
            'chapter_name' => 'GUI',
        ]);

        //8
        SubjectChapter::create([
            'subject_id' => '1',
            'chapter_no' => 6,
            'chapter_name' => 'NETWORKING',
        ]);

        //9
        SubjectChapter::create([
            'subject_id' => '1',
            'chapter_no' => 6,
            'chapter_name' => 'JDBC',
        ]);

        //10
        SubjectChapter::create([
            'subject_id' => '1',
            'chapter_no' => 6,
            'chapter_name' => 'JSTL',
        ]);

        //11
        SubjectChapter::create([
            'subject_id' => '1',
            'chapter_no' => 6,
            'chapter_name' => 'JAVA FX',
        ]);

        //12
        SubjectChapter::create([
            'subject_id' => '1',
            'chapter_no' => 6,
            'chapter_name' => 'ANDROID',
        ]);
    }
}
