<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', ['as' => 'login', 'uses' => 'AuthController@login']);
Route::post('/handleLogin', ['as' => 'handleLogin', 'uses' => 'AuthController@handleLogin']);
Route::get('/register', ['as' => 'register', 'uses' => 'AuthController@register']);
Route::post('/handleRegister', ['as' => 'handleRegister', 'uses' => 'AuthController@handleRegister']);
Route::resource('users', 'studentRegisterController', ['only' => ['index', 'create', 'store']]);
Route::group(['middleware' => 'auth'], function()
{
    Route::get('/logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);
    
    //admin controller start//
    //untuk admin sendiri start//
    Route::resource('admin', 'AdminController', ['only' => ['index', 'create', 'store', 'show', 'destroy','update', 'edit']]);
    Route::get('/profileAdmin', ['as' => 'profileAdmin', 'uses' => 'AdminController@profileAdmin']);
    Route::get('/editPassword', ['as' => 'editPassword', 'uses' => 'AdminController@editPassword']);
    Route::patch('/handleEditPassword', ['as' => 'handleEditPassword', 'uses' => 'AdminController@handleEditPassword']);
    Route::get('/avatarAdmin', ['as' => 'avatarAdmin', 'uses' => 'AdminController@avatarAdmin']);
    Route::post('/handleAvatarAdmin', ['as' => 'handleAvatarAdmin', 'uses' => 'AdminController@handleAvatarAdmin']);
    //end//

    //for operations on users type=admin start//
    Route::resource('adminOperation', 'AdminOperationController', ['only' => ['show', 'edit', 'update', 'destroy']]);
    Route::get('/newAdmin', ['as' => 'newAdmin', 'uses' => 'AdminOperationController@newAdmin']); //page new/list admin
    Route::post('/newAdmin', ['as' => 'handleNewAdmin', 'uses' => 'AdminOperationController@handleNewAdmin']); //insert new admin
    //end//

    //for operations on users type=lecturer
    //start//
    Route::resource('lecturerOperation', 'LecturerOperationController', ['only' => ['store', 'show', 'edit', 'update', 'destroy']]);
    Route::get('/lecturers', ['as' => 'viewAllLecturer', 'uses' => 'LecturerOperationController@viewAllLecturer']); //page list lecturer
    Route::get('/newLecturer', ['as' => 'newLecturer', 'uses' => 'LecturerOperationController@newLecturer']);
    //end//

    //for operation on users type=student
    //start//
    Route::resource('studentOperation', 'StudentOperationController', ['only' => ['store', 'show', 'edit', 'update', 'destroy']]);
    Route::get('/students', ['as' => 'viewAllStudent', 'uses' => 'StudentOperationController@viewAllStudent']); //page list lecturer
    Route::get('/newStudent', ['as' => 'newStudent', 'uses' => 'StudentOperationController@newStudent']);
    //end//

    //for operation on subjects by admin
    //start//
    Route::resource('subjectOperation', 'SubjectOperationController', ['only' => ['store', 'edit', 'update', 'destroy']]);
    Route::get('/subjects', ['as' => 'viewAllSubject', 'uses' => 'SubjectOperationController@viewAllSubject']); //page list subjects
    Route::get('/viewChapters/{id}', ['as' => 'viewChapters', 'uses' => 'SubjectOperationController@viewChapters']);
    Route::get('/addChapters/{id}', ['as' => 'addChapters', 'uses' => 'SubjectOperationController@addChapters']);
    Route::get('/editChapters/{id}', ['as' => 'editChapters', 'uses' => 'SubjectOperationController@editChapters']);
    Route::post('/handleEditChapters/{id}', ['as' => 'handleEditChapters', 'uses' => 'SubjectOperationController@handleEditChapters']);
    Route::get('/deleteChapter/{id}', ['as' => 'deleteChapter', 'uses' => 'SubjectOperationController@deleteChapter']);
    //end//

    //for operation on semesters
    Route::resource('semesterOperation', 'SemesterOperationController', ['only' => ['show', 'store', 'edit', 'update', 'destroy']]);
    Route::get('/semesters', ['as' => 'semesters', 'uses' => 'SemesterOperationController@semesters']);
    
    //for operation on programmes
    Route::resource('programmeOperation', 'ProgrammeOperationController', ['only' => ['show', 'store', 'edit', 'update', 'destroy']]);
    Route::get('/programmes', ['as' => 'programmes', 'uses' => 'ProgrammeOperationController@programmes']);
    //for operation on classes by admin//
    //start//
    Route::resource('classroomOperation', 'ClassroomOperationController', ['only' => ['store', 'show', 'edit', 'update', 'destroy']]);
    Route::get('/newClass', ['as' => 'newClassroom', 'uses' => 'ClassroomOperationController@newClassroom']); //page list subjects
    Route::get('/classes', ['as' => 'viewAllClassroom', 'uses' => 'ClassroomOperationController@viewAllClassroom']); //page list subjects
    Route::post('/classesFiltered', ['as' => 'viewAllClassroomFiltered', 'uses' => 'ClassroomOperationController@viewAllClassroomFiltered']);
    Route::get('/resetEnrollmentKey/{id}', ['as' => 'resetEnrollmentKey', 'uses' => 'ClassroomOperationController@resetEnrollmentKey']);
    //end//

    //for operation on questions by admin//
    //start
//    Route::resource('questionOperation', 'QuestionOperationController', ['only' => ['index']]);
    Route::get('/questions', ['as' => 'viewAllQuestions', 'uses' => 'QuestionOperationController@viewAllQuestions']);
    Route::post('/questionsFiltered', ['as' => 'viewAllQuestionsFiltered', 'uses' => 'QuestionOperationController@viewAllQuestionsFiltered']);
    //end//

    //admin controller end//
    
    //lecturer controller
    //!!start!!//
    //untuk lecturer sendiri
    //start..
    Route::resource('lecturer', 'LecturerController', ['only' => ['index', 'store', 'show', 'edit', 'update', 'destroy']]);
    Route::get('/profileLecturer', ['as' => 'profileLecturer', 'uses' => 'LecturerController@profileLecturer']);
    Route::get('/avatarLecturer', ['as' => 'avatarLecturer', 'uses' => 'LecturerController@avatarLecturer']);
    Route::post('/handleAvatarLecturer', ['as' => 'handleAvatarLecturer', 'uses' => 'LecturerController@handleAvatarLecturer']);
    Route::get('/editPasswordLecturer', ['as' => 'editPasswordLecturer', 'uses' => 'LecturerController@editPasswordLecturer']);
    Route::patch('/handleEditPasswordLecturer', ['as' => 'handleEditPasswordLecturer', 'uses' => 'LecturerController@handleEditPasswordLecturer']);
    //end..

    //untuk lecturer nak buat operation on subjects
    //1start1//mungkin tak nak pakai
    Route::resource('lecturerSubjectOperation', 'LecturerSubjectOperationController', ['only' => ['index', 'store', 'show', 'edit', 'update', 'destroy']]);
    Route::get('/l_subjects', ['as' => 'l_viewAllSubject', 'uses' => 'LecturerSubjectOperationController@viewAllSubject']); //page list subjects
    //1end1//

    //untuk lecturer nak buat operation on classrooms
    //+start+
    Route::resource('lecturerClassroomOperation', 'LecturerClassroomOperationController', ['only' => ['index', 'store', 'show', 'edit', 'update', 'destroy']]);
    Route::get('/l_newClass', ['as' => 'l_newClass', 'uses' => 'LecturerClassroomOperationController@newClassroom']);
    Route::get('/l_classes', ['as' => 'l_viewAllClassroom', 'uses' => 'LecturerClassroomOperationController@viewAllClassroom']);
    Route::post('l_classesFiltered', ['as' => 'l_viewAllClassroomFiltered', 'uses' => 'LecturerClassroomOperationController@viewAllClassroomFiltered']);
    Route::get('/l_classEditEK/{id}', ['as' => 'l_editClassroomEK', 'uses' => 'LecturerClassroomOperationController@editClassroomEnrollmentKey']);
    Route::post('/l_handleClassEditEK', ['as' => 'l_handleEditClassroomEK', 'uses' => 'LecturerClassroomOperationController@handleEditClassroomEnrollmentKey']);
    //+end+

    //untuk lecturer nak buat operation on assessments papers
    //==start==
//    Route::get('l_assessments', ['as' => 'l_viewAllAssessment', 'uses' => 'LecturerAssessmentPaperOperationController@viewAllAssessment']);
    Route::resource('lecturerAssessmentOperation', 'LecturerAssessmentOperationController', ['only' => ['index', 'store', 'show', 'edit', 'update', 'destroy']]);
    Route::get('/l_terminateAssessment/{id}', ['as' => 'l_terminateAssessment', 'uses' => 'LecturerAssessmentOperationController@terminateAssessment']);
    //untuk view report summary
    Route::get('/l_assessmentSummary/{id}', ['as' => 'l_assessmentSummary', 'uses' => 'LecturerAssessmentOperationController@assessmentSummary']);    
    //guna untuk page manage assessments operation on so on
    Route::resource('l_AssessmentQuestionOperation', 'LecturerAssessmentQuestionOperationController', ['only' => ['create', 'store', 'show', 'edit', 'update', 'destroy']]);
    Route::get('/l_manageQuestionsMarks/{id}', ['as' => 'l_manageQuestionsMarks', 'uses' => 'LecturerAssessmentQuestionOperationController@create']);
    Route::post('/l_handleQuestionsMarks', ['as' => 'l_handleQuestionsMarks', 'uses' => 'LecturerAssessmentQuestionOperationController@handleAssessmentQuestionMarks']);
    //guna just untuk delete assessments questions for an assessments
    Route::resource('l_AssessmentQuestionRemove', 'LecturerAssessmentQuestionRemoveOperationController', ['only' => ['edit', 'update', 'index']]);
    Route::get('l_assessments', ['as' => 'l_viewAllAssessment', 'uses' => 'LecturerAssessmentOperationController@viewAllAssessment']);
    Route::post('l_assessmentsFiltered', ['as' => 'l_viewAllAssessmentFiltered', 'uses' => 'LecturerAssessmentOperationController@viewAllAssessmentFiltered']);
    Route::post('l_assessmentStatus', ['as' => 'l_assessmentOperationUpdateStatus', 'uses' => 'LecturerAssessmentOperationController@updateAssessmentStatus']);
    //edit start or end assessment date
    Route::get('/l_editAssessmentOpenDate/{id}', ['as' => 'l_editAssessmentOpenDate', 'uses' => 'LecturerAssessmentOperationController@editAssessmentOpenDate']);
    Route::get('/l_editAssessmentCloseDate/{id}', ['as' => 'l_editAssessmentCloseDate', 'uses' => 'LecturerAssessmentOperationController@editAssessmentCloseDate']);
    Route::post('/l_updateAssessmentOpenDate/{id}', ['as' => 'l_updateAssessmentOpenDate', 'uses' => 'LecturerAssessmentOperationController@updateAssessmentOpenDate']);
    Route::post('/l_updateAssessmentCloseDate/{id}', ['as' => 'l_updateAssessmentCloseDate', 'uses' => 'LecturerAssessmentOperationController@updateAssessmentCloseDate']);
    
    Route::get('l_newAssessment', ['as' => 'l_newAssessment', 'uses' => 'LecturerAssessmentOperationController@newAssessment']); //belom pilih class
    Route::post('l_newAssessmentSelected', ['as' => 'l_newAssessmentSubjectSelected', 'uses' => 'LecturerAssessmentOperationController@newAssessmentSelected']); //subject dah pilih
    Route::get('l_newAssessmentQuestion', ['as' => 'l_newAssessmentQuestion', 'uses' => 'LecturerAssessmentOperationController@newAssessmentQuestions']);
    Route::get('l_assessmentQuestion', ['as' => 'l_assessmentQuestion', 'uses' => 'LecturerAssessmentOperationController@assessmentQuestion']);
    
    Route::get('/l_revealMarks/{id}', ['as' => 'l_revealMarks', 'uses' => 'LecturerAssessmentOperationController@revealMarks']);
    //operation on view student & student's assessment answer
    Route::get('/l_viewStudent/{id}', ['as' => 'l_studentOperation.index', 'uses' => 'LecturerStudentOperationController@index']);
    Route::resource('l_studentOperation', 'LecturerStudentOperationController', ['only' => ['show']]);
//    Route::post('/l_fineDiff', ['as' => 'l_fineDiff', 'uses' => 'LecturerViewStudentAnswerOperationController@index']);
    Route::post('/l_toCompare', ['as' => 'l_toCompare', 'uses' => 'LecturerViewStudentAnswerOperationController@toCompare']);
    Route::post('/l_fineDiff', ['as' => 'l_fineDiff', 'uses' => 'LecturerViewStudentAnswerOperationController@fineDiff']);
    Route::resource('l_studentAnswer', 'LecturerViewStudentAnswerOperationController', ['only' => ['show', 'index', 'store']]);
    Route::get('/l_compareTwoStudentAnswer/{a_id}/{f_s_id}/{s_s_id}', ['as' => 'l_compareTwoStudent', 'uses' => 'LecturerViewStudentAnswerOperationController@compareTwoStudent']);
    Route::post('/l_editMarks', ['as' => 'l_editStudentAssessmentMarks', 'uses' => 'LecturerViewStudentAnswerOperationController@editStudentAssessmentMarks']);
//    Route::resource('')
    //similarities checker
    Route::resource('l_similarityChecker', 'LecturerSimilarityCheckerOperationController', ['only' => ['show', 'edit', 'index']]);
    Route::post('/l_viewSimilarity', ['as' => 'l_viewSimilarity', 'uses' => 'LecturerSimilarityCheckerOperationController@changeStudent']);

    //technique 2 string compare
    Route::get('/l_viewSimilarity/{id}', ['as' => 'l_viewSimilarity.index', 'uses' => 'LecturerCompareAnswerOperationController@index']);
//    Route::post('/l_viewSimilarity', ['as' => 'l_viewSimilarity', 'uses' => 'LecturerCompareAnswerOperationController@changeStudent']);
    Route::resource('l_viewSimilarity', 'LecturerCompareAnswerOperationController', ['only' => ['show']]);

    //==end==
//    Route::get('/try', ['as' => 'l_try', 'uses' => 'LecturerSimilarityCheckerOperationController@edit']);
    //untuk lecturer nak buat operation on questions
    //start**
    Route::get('/l_addQuestion', ['as' => 'lecturerAddQuestion', 'uses' => 'LecturerQuestionOperationController@addQuestion']);
    Route::post('/l_addQuestionSelected', ['as' => 'lecturerAddQuestionSelected', 'uses' => 'LecturerQuestionOperationController@addQuestionSelected']);
    Route::post('/l_handleAddQuestion', ['as' => 'lecturerHandleAddQuestion', 'uses' => 'LecturerQuestionOperationController@handleAddQuestion']);
    
    
    Route::get('/l_newQuestion/{id}', ['as' => 'lecturerQuestionOperation.index', 'uses' => 'LecturerQuestionOperationController@index']);
    Route::resource('lecturerQuestionOperation', 'LecturerQuestionOperationController', ['only' => ['create', 'store', 'show', 'edit', 'update', 'destroy']]);
    Route::post('/l_newQuestionSelected', ['as' => 'lecturerNewQuestionSubjectSelected', 'uses' => 'LecturerQuestionOperationController@createSelected']);
    Route::post('l_createFiltered', ['as' => 'lecturerNewQuestionFiltered', 'uses' => 'LecturerQuestionOperationController@createFiltered']);
//    Route::post('/l_filterQuestionSubject', ['as' => 'lecturerFilterQuestionSubject', 'uses' => 'LecturerQuestionOperationController@filterQuestionSubject']);
    Route::get('/l_viewAllQuestions', ['as' => 'lecturerViewAllQuestions', 'uses' => 'LecturerQuestionOperationController@viewAllQuestions']);
    Route::post('/l_viewAllQuestionsSelected', ['as' => 'lecturerViewAllQuestionsSelected', 'uses' => 'LecturerQuestionOperationController@viewAllQuestionsSelected']);
    Route::get('/l_deleteQuestion/{id}', ['as' => 'l_deleteQuestion', 'uses' => 'LecturerQuestionOperationController@deleteQuestion']);
//    Route::get('/l_filterQuestionSubject', ['as' => 'lecturerFilterQuestionSubject', 'uses' => 'LecturerQuestionOperationController@register']);
//    Route::get('l_newQuestion', ['as' => 'l_newQuestion', 'uses' => 'LecturerQuestionOperationController@newQuestion']);
    //end**

    //!!end lecturer controller!!//
    
    //student controller
    //start//
    //untuk student sendiri
    //start===
    Route::resource('student', 'StudentController', ['only' => ['index', 'create', 'store', 'show', 'destroy','update', 'edit']]);
    Route::get('/profileStudent', ['as' => 'profileStudent', 'uses' => 'StudentController@profileStudent']);
    Route::get('/s_editPassword', ['as' => 's_editPassword', 'uses' => 'StudentController@editPassword']);
    Route::patch('/s_handleEditPassword', ['as' => 's_handleEditPassword', 'uses' => 'StudentController@handleEditPassword']);
    Route::get('/avatarStudent', ['as' => 'avatarStudent', 'uses' => 'StudentController@avatarStudent']);
    Route::post('/handleAvatarStudent', ['as' => 'handleAvatarStudent', 'uses' => 'StudentController@handleAvatarStudent']);
    //end==

    //untuk operation on classroom
    //start$$$
    Route::resource('studentClassroomOperation', 'StudentClassroomOperationController', ['only' => ['show', 'create', 'store', 'edit', 'update', 'destroy']]);
    Route::get('/s_classDetails/{id}', ['as' => 's_classDetails', 'uses' => 'StudentClassroomOperationController@classDetails']);
    Route::get('/s_classes', ['as' => 's_viewAllClassroom', 'uses' => 'StudentClassroomOperationController@viewAllClassroom']);
    Route::post('/s_classesFiltered', ['as' => 's_viewAllClassroomFiltered', 'uses' => 'StudentClassroomOperationController@viewAllClassroomFiltered']);
    Route::get('/s_enroll', ['as' => 's_enrollClassroom', 'uses' => 'StudentClassroomOperationController@enrollClassroom']);
    Route::get('/s_enrolledClass', ['as' => 's_viewEnrolledClassroom', 'uses' => 'StudentClassroomOperationController@viewEnrolledClassroom']);
    //end$$$

    //untuk operation on assessments
    //start+++
    Route::resource('studentAssessmentOperation', 'StudentAssessmentOperationController', ['only' => ['show', 'store', 'edit', 'update']]);
    Route::resource('studentAssessmentAttempt', 'StudentAssessmentAttemptOperationController', ['only' => ['show', 'store', 'edit', 'update']]);
    //route after student submit paper
    Route::get('/s_assessmentDone/{id}', ['as' => 's_assessmentDone', 'uses' => 'StudentAssessmentAttemptOperationController@assessmentDone']);
    Route::resource('studentAssessmentDone', 'StudentAssessmentDoneOperationController', ['only' => ['index', 'show', 'store', 'edit', 'update']]);
    Route::get('/s_assessments', ['as' => 's_viewAllAssessment', 'uses' => 'StudentAssessmentOperationController@viewAllAssessment']);
    Route::post('/s_attemptAssessment', ['as' => 's_storeAttemptAssessment', 'uses' => 'StudentAssessmentOperationController@storeAttemptAssessment']);
    Route::post('s_test', ['as' => 's_test', 'uses' => 'StudentAssessmentOperationController@s_test']);
        //end+++
    //end//

});