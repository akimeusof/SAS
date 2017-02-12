<?php

namespace App\Http\Controllers;


use App\Validation;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Admin;
use App\User;
use App\AdminProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;


class AdminOperationController extends Controller
{
    public function newAdmin()
    {
        $admins = User::join('adminprofiles', 'users.id', '=', 'adminprofiles.user_id')
            ->select('users.*')
            ->where('users.type', 'admin', 'AND')
            ->where('users.status', 1)
            ->orderBy('adminprofiles.name')
            ->get();
//        $admins = User::all();
        return view('users.admin.users.newAdmin')->with('admins', $admins);
    }

    public function handleNewAdmin(Request $request){
        $this->validate($request, Validation::$insertAdminValidationRules);
        $data = $request->only('username', 'type', 'status'); //request kalau byk sgt pakai all()
        $data['password'] = bcrypt($data['username']);
        $user = User::create($data);

        $profile = new AdminProfile([
            'id' => $request->id,
            'program' => $request->program,
            'name' => $request->name,
            'email' => $request->email,
            'phonenumber' => $request->phonenumber,
            'homenumber' => $request->homenumber,
            'address' => $request->address,
            'status' => 1
        ]);

        $user->AdminProfile()->save($profile);

        if($user && $profile){
            $usernameUpper = strtoupper($request->username);
            \Session::flash('successMessage', 'Admin '.$usernameUpper.' successfully registered.');
            return redirect()->action('AdminOperationController@newAdmin');
        }
        return redirect()->action('AdminOperationController@newAdmin')->$this->withErrors(['errors' => 'Problem occurred during registration process.']);
    }
    
    public function show($id)
    {
        $user = User::find($id);
        $admins = User::join('adminprofiles', 'users.id', '=', 'adminprofiles.user_id')
            ->select('users.*')
            ->where('users.type', 'admin', 'AND')
            ->where('users.status', 1)
            ->orderBy('adminprofiles.name')
            ->get();
        return view('users.admin.users.newAdminView', array('user' => $user))->with('admins', $admins);
    }


    public function edit($id)
    {
        //for admin list
        $user = User::find($id);
        $admins = User::join('adminprofiles', 'users.id', '=', 'adminprofiles.user_id')
            ->select('users.*')
            ->where('users.type', 'admin', 'AND')
            ->where('users.status', 1)
            ->orderBy('adminprofiles.name')
            ->get();
        return view('users.admin.users.newAdminEdit', array('user' => $user))->with('admins', $admins);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'username' => 'required|unique:users,username,'.$id.',id',
            'id' => 'required|unique:adminprofiles,id,'.$id.',user_id',
            'email' => 'required|unique:adminprofiles,email,'.$id.',user_id',
//            'email' => 'unique:users,email_address,'.$user->id
        ]);
        $user = User::find($id)->update([
            'username' => $request->username
        ]);
        $profile = AdminProfile::where('user_id', $id)
            ->update(
                [
//                    'user' => $request->username,
                    'id' => $request->id,
                    'name' => $request->name,
                    'email' => $request->email,
                    'phonenumber' => $request->phonenumber,
                    'homenumber' =>$request->homenumber,
                    'address' => $request->address
                ]
            );
        if($user && $profile){
            $user = User::find($id);
            $usernameUpper = strtoupper($user->username);
            \Session::flash('successMessage', 'Profile '.$usernameUpper.' successfully updated.');
            return redirect()->action('AdminOperationController@newAdmin');
        }
        return redirect()->action('AdminOperationController@newAdmin')->$this->withErrors(['errors' => 'Problem occurred during update process.']);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->status = 0;
        $user->save();
        if ($user) {
            $usernameUpper = strtoupper($user->username);
            \Session::flash('successMessage', $usernameUpper.' successfully deleted.');
            return redirect()->action('AdminOperationController@newAdmin');
        }
        return back()->$this->withErrors(['errors' => 'Problem occurred during deletion process.']);
    }

    public function index()
    {
        $admins = User::join('adminprofiles', 'users.id', '=', 'adminprofiles.user_id')
            ->select('users.*')
            ->where('users.type', 'admin', 'AND')
            ->where('users.status', 1)
            ->orderBy('adminprofiles.name')
            ->get();
        return view('users.admin.users.newAdmin')->with('admins', $admins);
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }
}
