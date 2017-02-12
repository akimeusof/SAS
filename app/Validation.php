<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Validation extends Model
{
    //common
    public static $changeProfilePhotoValidationRules =[
        'avatar' => 'mimes:jpeg,jpg,png'
    ];
    
    //end common
    
    //validation untuk admin begin..
    //for operation on admin start--
    public static $insertAdminValidationRules = [
        'username' => 'required|min:4|max:32|unique:users',
        'id' => 'required|min:6|max:12|unique:adminprofiles',
        'name' => 'required',
        'email' => 'required|email|unique:adminprofiles',
    ];

    public static $insertLecturerValidationRules = [
        'username' => 'required|min:4|max:32|unique:users',
        'id' => 'required|min:6|max:12|unique:studentprofiles',
        'name' => 'required',
        'email' => 'required|email|unique:studentprofiles',
        'programme' => 'required',
    ];

    public static $insertStudentValidationRules = [
        'username' => 'required|min:4|max:32|unique:users',
        'id' => 'required|min:6|max:12|unique:lecturerprofiles',
        'name' => 'required',
        'email' => 'required|email|unique:lecturerprofiles',
    ];
    //end--

    //for subject operation start???
    public static $insertSubjectValidationRules = [
        'code' => 'required|unique:subjects',
        'name' => 'required'
    ];
    //end???
    //for classroom operation
    //start!!
    public static $adminCreateClassroomValidationRules = [
        'subject' => 'required',
        'lecturer' => 'required',
        'enrollmentkey' => 'required|min:8',
        'section' => 'required',
        'capacity' => 'required'
    ];
    //end!!
    //validation untuk admin end..

    //validation untuk LECTURER begin..
    //for classroom operation
    //start==
    public static $lecturerCreateClassroomValidationRules = [
        'semester' => 'required',
        'subject' => 'required',
        'section' => 'required',
        'capacity' => 'required',
        'enrollmentkey' => 'required|min:8'
    ];
    //end==

    //for assessments operation
    //start!!
    public static $lecturerCreateAssessmentValidationRules = [
        'classroom' => 'required',
        'assessment_name' => 'required',
        'assessment_marks' => 'required',
        'number_of_question' => 'required',
        'time_limit' => 'required',
        'open_date' =>'required',
        'open_time' => 'required',
        'close_date' => 'required',
        'close_time' => 'required'
    ];
    
    //end!!
    //validation untuk LECTURER end..

    //validation untuk student begin..!!
    //untuk register
    public static $studentRegisterValidationRules = [
        'username' => 'required|unique:users|min:5|max:32',
        'password' => 'required|min:5|max:60',
        'id' => 'required|unique:studentprofiles|min:8|max:8',
        'programme_id' => 'required',
        'name' => 'required',
        'email' => 'required|email|unique:studentprofiles',

    ];
    //untuk enroll classroom
    //start..
    public static $studentEnrollClassroomValidationRules = [
        'subject' => 'required',
        'lecturer' => 'required',
        'enrollmentkey' => 'required|min:8'
    ];
    //end..
    //end..!!
}
