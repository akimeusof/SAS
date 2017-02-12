<?php

namespace App\Http\Controllers;

use App\Programme;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProgrammeOperationController extends Controller
{
    public function programmes()
    {
        $programmes = Programme::where('status', 1)->orderBy('name', 'asc')->get();
        return view('users.admin.programmes.viewAllProgrammes')->with('programmes',$programmes);
    }
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request,[
           'programme_name' => 'required'
        ]);
        $create = Programme::create([
           'name' => $request->programme_name,
            'status' => 1
        ]);
        if($create){
            \Session::flash('successMessage', 'Programme successfully created');
            return redirect()->action('ProgrammeOperationController@programmes');
        }else {
            return redirect()->action('ProgrammeOperationController@programmes')->with(['errors' => 'Error occurred during insert process. Please try again later.']);
        }
    }

    public function edit($id)
    {
        $programmeSelected = Programme::find($id);
        $programmes = Programme::where('status', 1)->orderBy('name', 'asc')->get();
        return view('users.admin.programmes.editProgramme')->with('programmes',$programmes)->with('programmeSelected', $programmeSelected);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
//        dd($id);
        $programme = Programme::find($id);
        $delete = $programme->update([
            'status' => 0
        ]);
        if($delete){
            \Session::flash('successMessage', 'Programme successfully deleted');
            return redirect()->action('ProgrammeOperationController@programmes');
        }else {
            return redirect()->action('ProgrammeOperationController@programmes')->with(['errors' => 'Error occurred during delete process. Please try again later.']);
        }
    }
}
