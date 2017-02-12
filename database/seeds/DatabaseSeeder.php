<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UserTableSeeder::class);
        $this->call(ProgrammeTableSeeder::class);
        $this->call(SemesterTableSeeder::class);
        $this->call(AdminProfileTableSeeder::class);
        $this->call(LecturerProfileTableSeeder::class);
        $this->call(StudentProfileTableSeeder::class);
        $this->call(SubjectTableSeeder::class);
        $this->call(SubjectChapterTableSeeder::class);
        $this->call(QuestionTableSeeder::Class);
        $this->call(ClassroomTableSeeder::class);
        $this->call(EnrollmentTableSeeder::class);
        $this->call(AssessmentTableSeeder::class);
        $this->call(AssessmentQuestionTableSeeder::class);
        $this->call(AssessmentAttemptTableSeeder::class);
//        $this->call(AssessmentAnswerTableSeeder::class);

        Model::reguard();
    }
}
