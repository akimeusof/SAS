<?php

namespace App\Http\Controllers;

use App\Programme;
use App\Validation;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\StudentProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class StudentOperationController extends Controller
{
    public function newStudent()
    {
        $programmes = Programme::where('status', 1)->orderBy('name', 'asc')->get();
        return view('users.admin.users.newStudent')->with('programmes', $programmes);
    }
    public function viewAllStudent()
    {
        $students = User::join('studentprofiles', 'users.id', '=', 'studentprofiles.user_id')
            ->select('users.*')
            ->where('users.type', 'student', 'AND')
            ->where('users.status', 1)
            ->orderBy('studentprofiles.name', 'asc')
            ->orderBy('studentprofiles.email', 'asc')
            ->get();
        return view('users.admin.users.viewAllStudent')->with('students', $students);
    }

    public function store(Request $request)
    {
        $this->validate($request, Validation::$insertStudentValidationRules);
        if($request->progamme != ""){
            $data = $request->only('username', 'type', 'status'); //request kalau byk sgt pakai all()
            $data['password'] = bcrypt($data['username']);
            $user = User::create($data);
//        dd($request->programme);
            $profile = new StudentProfile([
                'id' => $request->id,
                'programme' => $request->programme,
                'name' => $request->name,
                'email' => $request->email,
                'phonenumber' => $request->phonenumber,
                'homenumber' => $request->homenumber,
                'address' => $request->address
            ]);

            $user->StudentProfile()->save($profile);

            if($user && $profile){
                $usernameUpper = strtoupper($request->username);
                \Session::flash('successMessage', 'Student '.$usernameUpper.' successfully registered.');
                return view('users.admin.users.newStudent');
            }
            return redirect()->action('StudentOperationController@newStudent')->$this->withErrors(['errors' => 'Problem occurred during registration process.']);
        }
        else {
            return back()->withInput()->withErrors(['errors' => 'Please choose a programme.']);
        }
    }

    public function show($id)
    {
        $student = User::find($id);
        return view('users.admin.users.viewStudent', array('student' => $student));
    }

    public function edit($id)
    {
        $student = User::find($id);
        $programmes = Programme::where('status', 1)->orderBy('name', 'asc')->get();
        return view('users.admin.users.editStudent')->with('student', $student)->with('programmes', $programmes);
//        return view('users.admin.users.editStudent', array('student' => $student));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
           'username' => 'required|unique:users,username,'.$id.',id',
           'email' => 'required|unique:studentprofiles,email,'.$id.',user_id',
           'id' => 'required|unique:studentprofiles,id,'.$id.',user_id'
        ]);
        $user = User::find($id)->update(['username' => $request->username]);
//        $user->username = $request->username;
//        $user->save();
        $profile = StudentProfile::where('user_id', $id)
            ->update(
                [
                    'id' => $request->id,
                    'email' => $request->email,
                    'name' => $request->name,
                    'programme_id' => $request->programme_id,
                    'phonenumber' => $request->phonenumber,
                    'homenumber' =>$request->homenumber,
                    'address' => $request->address
                ]
            );
        if($user && $profile){
            $user = User::find($id);
            $usernameUpper = strtoupper($user->username);
            $student = $user;
            \Session::flash('successMessage', 'Student '.$usernameUpper.' successfully updated.');
//            return "ahaha";
            return view('users.admin.users.viewStudent')->with('student', $student);
        }
        return redirect()->action('StudentOperationController@viewAllStudent')->$this->withErrors(['errors' => 'Problem occurred during update process.']);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->status = 0;
        $user->save();

        if ($user) {
            $usernameUpper = strtoupper($user->username);
            \Session::flash('successMessage', 'Student '.$usernameUpper.' successfully deleted.');
            return redirect()->action('StudentOperationController@viewAllStudent');
        }
        return redirect()->action('StudentOperationController@viewAllStudent')->$this->withErrors(['errors' => 'Problem occurred during update process.']);
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
