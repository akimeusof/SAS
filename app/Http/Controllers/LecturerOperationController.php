<?php

namespace App\Http\Controllers;
use App\Validation;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\LecturerProfile;
use Illuminate\Support\Facades\Auth;

class LecturerOperationController extends Controller
{
    //untuk admin nak operate lecturer!!!
    public function newLecturer()
    {
        return view('users.admin.users.newLecturer');
    }
    
    public function viewAllLecturer()
    {
        $lecturers = User::join('lecturerprofiles', 'users.id', '=', 'lecturerprofiles.user_id')
            ->select('users.*')
            ->where('users.type', 'lecturer', 'AND')
            ->where('users.status', 1)
            ->orderBy('lecturerprofiles.name', 'asc')
            ->get();
        return view('users.admin.users.viewAllLecturer')->with('lecturers', $lecturers);
    }

    public function store(Request $request)
    {
        $this->validate($request, Validation::$insertLecturerValidationRules);
        $data = $request->only('username', 'type', 'status'); //request kalau byk sgt pakai all()
        $data['password'] = bcrypt($data['username']);
        $user = User::create($data);

        $profile = new LecturerProfile([
            'id' => $request->id,
            'name' => $request->name,
            'email' => $request->email,
            'phonenumber' => $request->phonenumber,
            'homenumber' => $request->homenumber,
            'address' => $request->address
        ]);

        $user->LecturerProfile()->save($profile);

        if($user && $profile){
            $usernameUpper = strtoupper($request->username);
            \Session::flash('successMessage', 'Lecturer '.$usernameUpper.' successfully registered.');
//            \Session::flash('successMessage', 'Lecturer '.$usernameUpper.' successfully registered.');
            return view('users.admin.users.newLecturer');
        }
        return redirect()->action('LecturerOperationController@newLecturer')->$this->withErrors(['errors' => 'Problem occurred during update process.']);
    }

    public function show($id)
    {
        $lecturer = User::find($id);
        return view('users.admin.users.viewLecturer', array('lecturer' => $lecturer));
    }

    public function edit($id)
    {
        $lecturer = User::find($id);
        return view('users.admin.users.editLecturer', array('lecturer' => $lecturer));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'username' => 'required|unique:users,username,'.$id.',id',
//            'id' => 'required|unique:lecturerprofiles,id,'.$id.',user_id',
            'email' => 'required|unique:lecturerprofiles,email,'.$id.',user_id',
        ]);
        $user = User::find($id)->update([
            'username' => $request->username
        ]);
        $profile = LecturerProfile::where('user_id', $id)
            ->update(
                [
                    'name' => $request->name,
                    'phonenumber' => $request->phonenumber,
                    'homenumber' =>$request->homenumber,
                    'address' => $request->address
                ]
            );
        if($user && $profile){
            $user = User::find($id);
            $usernameUpper = strtoupper($user->username);
            \Session::flash('successMessage', 'Lecturer '.$usernameUpper.' successfully updated.');
            return redirect()->action('LecturerOperationController@viewAllLecturer');
        }
        return redirect()->action('LecturerOperationController@viewAllLecturer')->$this->withErrors(['errors' => 'Problem occurred during update process.']);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->status = 0;
        $user->save();
        if ($user) {
            $usernameUpper = strtoupper($user->username);
            \Session::flash('successMessage', 'Lecturer '.$usernameUpper.' successfully deleted.');
            return redirect()->action('LecturerOperationController@viewAllLecturer');
        }
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

}
