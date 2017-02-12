<?php

namespace App\Http\Controllers;

use App\StudentProfile;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Programme;
use App\Validation;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function handleLogin(Request $request)
    {
        $this->validate($request, User::$loginValidationRules);
        $data = $request->only('username', 'password');
        if (\Auth::attempt($data)) {
            if (\Auth::user()->type == 'admin' && \Auth::user()->status == 1) {
                return redirect()->intended('admin');
            } elseif (\Auth::user()->type == 'lecturer' && \Auth::user()->status == 1) {
                return redirect()->route('l_viewAllClassroom');
            } elseif (\Auth::user()->type == 'student' && \Auth::user()->status == 1) {
                return redirect()->intended('student');
            }
        }
        return back()->withInput()->withErrors(['login' => 'Username or password is invalid.']);
    }

    public function logout()
    {
        \Auth::logout();
        flush();
        return redirect()->intended('login');
    }

    public function register(){
        $programmes = Programme::where('status', 1)->orderBy('name', 'asc')->get();
        return view('auth.register')->with('programmes', $programmes);
    }
    public function handleRegister(Request $request)
    {
        $this->validate($request, Validation::$studentRegisterValidationRules);
        $data = $request->only('username', 'password', 'type', 'status'); //request kalau byk sgt pakai all()
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);

        $profile = new StudentProfile([
            'id' => $request->id,
            'programme_id' => $request->programme_id,
            'name' => $request->name,
            'email' => $request->email
        ]);

        $user->studentprofile()->save($profile);

        if($user && $profile){
            \Session::flash('successMessage', 'Successfully registered. Proceed to login.');
            return redirect()->action('AuthController@login');
        }


    }
}
