<?php

namespace App\Http\Controllers;

use Faker\Provider\zh_TW\DateTime;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\LecturerProfile;
use App\User;

class LecturerController extends Controller
{
    public function index()
    {
        return view('users.lecturer.index');
    }

    public function profileLecturer()
    {
        $lecturer = \Auth::user();
        return view('users.lecturer.profileLecturer')->with('lecturer', $lecturer);
    }

    public function avatarLecturer()
    {
        $lecturer = \Auth::user();
        return view('users.lecturer.avatarLecturer')->with('lecturer', $lecturer);
    }

    public function handleAvatarLecturer(Request $request)
    {
        if($request->hasFile('avatar')) {
            if ($request->file('avatar')->getSize() <= 5000000) {
                $user = \Auth::user();
                $user_id = \Auth::user()->id;
                $user_username = \Auth::user()->username;
                $avatar = $request->file('avatar');
                $filename = $user_id . '-' . $user_username . '-' . date('m-d-Y_hia') . '.' . $avatar->getClientOriginalExtension(); //create file name and get type
                $insertPicture = \Image::make($avatar)->resize(450, 450)->save(public_path('/uploads/avatar/' . $filename));//insert file to folder upload
                $updateAvatar = LecturerProfile::where('user_id', $user_id)->update([
                    'avatar' => $filename
                ]);
                if ($insertPicture && $updateAvatar) {
                    \Session::flash('successMessage', 'Profile picture successfully updated.');
                    return redirect()->action('LecturerController@profileLecturer');
                }
                return redirect()->action('LecturerController@profileLecturer')->withErrors(['error' => 'Error occured during updating process.']);
                }
                else {
                    return back()->withInput()->withErrors(['errors' => 'Please choose a picture less than 5Mb to proceed.']);
                }
            }
            else {
            return back()->withInput()->withErrors(['errors' => 'Please choose a picture to proceed.']);
            }
    }

    public function editPasswordLecturer()
    {
        $lecturer = \Auth::user();
        return view('users.lecturer.editPasswordLecturer')->with('lecturer', $lecturer);

    }

    public function handleEditPasswordLecturer(Request $request)
    {
        $this->validate($request, [
            'currentpassword' => 'required',
            'newpassword' => 'required',
            'confirmpassword' => 'required'
        ]);
        $currentpassword = $request->currentpassword;
        $newpassword = $request->newpassword;
        $confirmpassword = $request->confirmpassword;

        if(\Hash::check($currentpassword, \Auth::user()->password))
        {
            if($newpassword==$confirmpassword)
            {
                $lecturer = \Auth::user();
                $lecturer->password = \Hash::make($newpassword);
                $lecturer->save();
                \Session::flash('successMessage', 'Password successfully updated.');
                return redirect()->intended('profileLecturer');
            }
            return back()->withErrors(['password' => 'The new password fields entered did not match with confirmation password.']);
        }
        return back()->withErrors(['password' => 'The password entered does not match']);
    }

    public function edit($id)
    {
//        method 1
        $lecturer = \Auth::user();
        return view('users.lecturer.updateProfileLecturer')->with('lecturer', $lecturer);
//        method 2
//        return view('users.lecturer.updateProfileLecturer', array('user' => \Auth::user()));
    }

    public function update(Request $request, $id)
    {
        //for profile
        $this->validate($request, [
            'username' => 'required|unique:users,username,'.$id.',id',
            'id' => 'required|unique:lecturerprofiles,id,'.$id.',user_id',
            'email' => 'required|unique:lecturerprofiles,email,'.$id.',user_id',
        ]);
        $lecturer = User::find($id);
        $update = $lecturer->update(['username' => $request->username]);
        $profile = LecturerProfile::where('user_id', $id)
            ->update(
                [
                    'id' => $request->id,
                    'name' => $request->name,
                    'email' => $request->email,
                    'phonenumber' => $request->phonenumber,
                    'homenumber' =>$request->homenumber,
                    'address' => $request->address
                ]
            );
        if($update && $profile){
            \Session::flash('successMessage', 'Profile successfully updated.');
            return redirect()->action('LecturerController@profileLecturer');
        }
        return redirect()->action('LecturerController@profileLecturer')->$this->withErrors(['errors' => 'Problem occurred during update process.']);;
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
