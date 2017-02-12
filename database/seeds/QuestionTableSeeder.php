<?php

use Illuminate\Database\Seeder;
use App\Question;

class QuestionTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('questions')->delete();
        //1
        Question::create([
            'subject_id' => 5,
            'user_id' => 3,
            'question' =>
                "Write a simple PHP class which displays the following string.
'This Assessment is Great!'",
            'answer' => "",
            'chapter_no' => 4,
            'use_type' => 0,
            'status' => 1
        ]);

        //2
        Question::create([
            'subject_id' => 5,
            'user_id' => 3,
            'question' =>
                "Write a PHP script to convert string to Date and DateTime.
Sample Date : '21-06-2016'
Expected Output : 2016-21-06",
            'answer' => '',
            'chapter_no' => 4,
            'use_type' => 0,
            'status' => 1
        ]);




        //3
        Question::create([
            'subject_id' => 5,
            'user_id' => 3,
            'question' =>
                "Create a script to construct the following pattern, using nested for loop.
*
* *
* * *
* * * *
* * * * *",
            'answer' => '',
            'chapter_no' => 4,
            'use_type' => 0,
            'status' => 1
        ]);

        //4
        Question::create([
            'subject_id' => 5,
            'user_id' => 3,
            'question' =>
                "Create a script to construct the following pattern, using a nested for loop.
*
* *
* * *
* * * *
* * * * *
* * * * *
* * * *
* * *
* *
*",
            'answer' => '',
            'chapter_no' => 4,
            'use_type' => 0,
            'status' => 1
        ]);

        //5
        $var = '$var';
        Question::create([
            'subject_id' => 5,
            'user_id' => 3,
            'question' =>
                "$var = 'PHP Tutorial'. Put this variable into the title section, h3 tag and as an anchor text within a HTML document.
Sample Output :

PHP Tutorial
PHP, an acronym for Hypertext Preprocessor, is a widely-used open source general-purpose scripting language. It is a cross-platform, HTML embedded server-side scripting language and is especially suited for web development.
",
            'answer' => '',
            'chapter_no' => 4,
            'use_type' => 0,
            'status' => 1
        ]);
        
    }
}
