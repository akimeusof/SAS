<?php

namespace App\Http\Controllers;

use App\Assessment;
use App\Classroom;
use App\Programme;
use App\Question;
use App\Semester;
use App\Subject;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\AdminProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class AdminController extends Controller
{
    public function index()
    {
        $user = \Auth::user();
        $users = User::all();
        $subjects = Subject::all()->where('status', 1);
        $classrooms = Classroom::all()->where('status', 1);
        $questions = Question::all()->where('status', 1);
        $assessments = Assessment::all();
        
        $userTypes = User::all()->lists('type')->toArray();
        $typeCollection = collect($userTypes);
        $getUnique = $typeCollection->unique();

        $classesSubject = Classroom::all()->lists('subject_id')->toArray();
        $cs_collection = collect($classesSubject);
        $getUniqueCS = $cs_collection->unique();
        return view('users.admin.index')
            ->with('user', $user)
            ->with('users', $users)
            ->with('getUnique', $getUnique)
            ->with('subjects', $subjects)
            ->with('classrooms', $classrooms)
            ->with('questions', $questions)
            ->with('getUniqueCS', $getUniqueCS)
            ->with('assessments', $assessments);
    }

    public function profileAdmin()
    {
        $user = \Auth::user();
        return view('users.admin.profileAdmin')->with('user', $user);
//        return view('users.admin.profileAdmin', array('user' => \Auth::user()));
    }

    //pakai untuk show profile admin
    public function edit($id)
    {
        return view('users.admin.updateProfileAdmin', array('user' => \Auth::user()));
    }

    //pakai untuk update data in profile admin
    public function update(Request $request, $id)
    {
        //for profile
        $this->validate($request, [
            'username' => 'required|unique:users,username,'.$id.',id',
            'id' => 'required|unique:adminprofiles,id,'.$id.',user_id',
            'email' => 'required|unique:adminprofiles,email,'.$id.',user_id',
        ]);
        $user = User::find($id);
        $update = $user->update([
            'username' => $request->username
        ]);
        $profile = AdminProfile::where('user_id', $id)
            ->update(
                [
                    'id' => $request->id,
                    'email' => $request->email,
                    'name' => $request->name,
                    'phonenumber' => $request->phonenumber,
                    'homenumber' =>$request->homenumber,
                    'address' => $request->address
                ]
            );
        if($user && $profile){
            \Session::flash('successMessage', 'Profile successfully updated.');
            return redirect()->action('AdminController@profileAdmin');
        }
        return redirect()->action('AdminController@profileAdmin')->withErrors(['errors' => 'Problem occurred during update process.']);
    }

    public function editPassword()
    {
        return view('users.admin.editPassword', array('user' => \Auth::user()));
    }

    public function handleEditPassword(Request $request)
    {
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
                return redirect()->intended('profileAdmin');
            }
            return back()->withErrors(['password' => 'The new password fields entered did not match with confirmation password.']);
        }
        return back()->withErrors(['password' => 'The password entered does not match']);
    }
    
    //edit profile photo
    public function avatarAdmin()
    {
        $admin = \Auth::user();
        return view('users.admin.avatarAdmin')->with('admin', $admin);
    }

    public function handleAvatarAdmin(Request $request)
    {
//        dd($request->avatar);
        if($request->hasFile('avatar')) {
            if ($request->file('avatar')->getSize() <= 5000000) {
                $user = \Auth::user();
                $user_id = \Auth::user()->id;
                $user_username = \Auth::user()->username;
                $avatar = $request->file('avatar');
                $filename = $user_id . '-' . $user_username . '-' . date('m-d-Y_hia') . '.' . $avatar->getClientOriginalExtension(); //create file name and get type
                $insertPicture = \Image::make($avatar)->resize(450, 450)->save(public_path('/uploads/avatar/' . $filename));//insert file to folder upload
                $updateAvatar = AdminProfile::where('user_id', $user_id)->update([
                    'avatar' => $filename
                ]);
                if ($insertPicture && $updateAvatar) {
                    \Session::flash('successMessage', 'Profile picture successfully updated.');
                    return redirect()->action('AdminController@profileAdmin');
                }
                return redirect()->action('AdminController@profileAdmin')->withErrors(['error' => 'Error occured during updating process.']);
            }
            return back()->withInput()->withErrors(['errors' => 'Please choose a picture less than 5Mb to proceed.']);
        }
        return back()->withInput()->withErrors(['errors' => 'Please choose a picture to proceed.']);
    }

    public function create()
    {

    }


    public function store(Request $request)
    {

    }

    public function show($id)
    {

    }

    public function destroy($id)
    {

    }

}
