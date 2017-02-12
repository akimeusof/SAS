<?php

namespace App\Http\Controllers;

use App\Enrollment;
use App\Programme;
use App\StudentProfile;
use App\Validation;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Symfony\Component\Routing\Matcher\RedirectableUrlMatcher;

use App\User;

class StudentController extends Controller
{
    public function index()
    {
        $user = \Auth::user();
        $classEnrolled = Enrollment::join('classrooms', 'enrollments.classroom_id', '=', 'classrooms.classroom_id')
            ->join('subjects', 'classrooms.subject_id', '=', 'subjects.subject_id')
            ->select('enrollments.*')
            ->where('enrollments.user_id', $user->id)
            ->orderBy('subjects.name', 'asc')
            ->orderBy('classrooms.section', 'asc')
            ->get();
        $classCollection = collect($classEnrolled);
        return view('users.student.index')
            ->with('user', $user)
            ->with('classEnrolled', $classEnrolled);
    }

    public function profileStudent()
    {
        $user = \Auth::user();
        return view('users.student.profileStudent')->with('user', $user);
    }
    
    public function editPassword()
    {
        $user = \Auth::user();
        return view('users.student.editPassword')->with('user', $user);
    }

    public function handleEditPassword(Request $request)
    {
//        dd($request);
        $currentpassword = $request->currentpassword;
        $newpassword = $request->newpassword;
        $confirmpassword = $request->confirmpassword;

        if(\Hash::check($currentpassword, \Auth::user()->password))
        {
            if($newpassword==$confirmpassword)
            {
                $user = \Auth::user();
                $user->password = \Hash::make($newpassword);
                $user->save();
                \Session::flash('successMessage', 'Password successfully updated.');
                return redirect()->action('StudentController@profileStudent');
            }
            return back()->withErrors(['password' => 'The new password fields entered did not match with confirmation password.']);
        }
        return back()->withErrors(['password' => 'The password entered does not match']);
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = \Auth::user();
//        dd($user->studentprofile->programme);
        $programmes = Programme::where('status', 1)->orderBy('name', 'asc')->get();
        return view('users.student.updateProfileStudent')->with('user', $user)->with('programmes', $programmes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
//        $username = $user->username;
//        $usernameUpper = strtoupper($username);
//        $user->save();
        $profile = StudentProfile::where('user_id', $id)
            ->update(
                [
                    'programme_id' => $request->programme_id,
                    'name' => $request->name,
                    'phonenumber' => $request->phonenumber,
                    'homenumber' =>$request->homenumber,
                    'address' => $request->address
                ]
            );
        if($profile){
            \Session::flash('successMessage', 'Profile successfully updated.');
            return redirect()->action('StudentController@profileStudent');
        }
        return redirect()->action('StudentController@profileStudent')->$this->withErrors(['errors' => 'Problem occurred during update process.']);;
    }

    //update profile photo
    public function avatarStudent()
    {
        $student = \Auth::user();
        return view('users.student.avatarStudent')->with('student', $student);
    }

    public function handleAvatarStudent(Request $request)
    {
//        $this->validate($request, Validation::$changeProfilePhotoValidationRules);
        if($request->hasFile('avatar')) {
            if ($request->file('avatar')->getSize() <= 5000000) {
                $user = \Auth::user();
                $user_id = \Auth::user()->id;
                $user_username = \Auth::user()->username;
                $avatar = $request->file('avatar');
                $filename = $user_id . '-' . $user_username . '-' . date('m-d-Y_hia') . '.' . $avatar->getClientOriginalExtension(); //create file name and get type
                $insertPicture = \Image::make($avatar)->resize(450, 450)->save(public_path('/uploads/avatar/' . $filename));//insert file to folder upload
                $updateAvatar = StudentProfile::where('user_id', $user_id)->update([
                    'avatar' => $filename
                ]);
                if ($insertPicture && $updateAvatar) {
                    \Session::flash('successMessage', 'Profile picture successfully updated.');
                    return redirect()->action('StudentController@profileStudent');
                }
                return redirect()->action('StudentController@profileStudent')->withErrors(['error' => 'Error occurred during updating process.']);
            }
            return back()->withInput()->withErrors(['errors' => 'Please choose an image less than 5Mb to proceed.']);
        }
        return back()->withInput()->withErrors(['errors' => 'Please choose an image file to proceed.']);
    }
    public function destroy($id)
    {
        //
    }
    public function create()
    {
        //
    }

}



