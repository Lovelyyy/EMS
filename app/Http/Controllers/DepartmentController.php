<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use DB, Input, Validator, Redirect, Hash;

class DepartmentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $data = Input::get('department');

        $departments = DB::table('departments')->where('dept_name', 'like', '%'.$data.'%')->paginate(5);
        return view('department', ['departments' => $departments, 'data' => $data]);
    }

    public function viewDepartment($id) {
        $details = DB::table('departments')->where('dept_id', $id)->get();
        return view('department_view', ['details' => $details[0]]);
    }

    public function showCreateForm() {
        return view('department_create');
    }

    public function postCreate(Request $request) {
        $rules = array(
            'Department'          => 'required|regex:/^[(a-zA-Z\s)]+$/u|between:2,20|unique:departments,dept_name',
            'Description'        => 'required|between:2,500',
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput(Input::all());
        }   else {
            DB::table('departments')->insert([
                'dept_name' => Input::get('Department'),
                'dept_desc' => Input::get('Description'),
            ]);

            $request->session()->flash('alert-success', 'Department has been successfully added!');
            return redirect(url('/department'));
        }
    }

    public function showEditForm($id) {
        $departments = DB::table('departments')->where('dept_id', $id)->get();
        return view('department_edit', ['details' => $departments[0]]);
    }

    public function postEdit(Request $request, $id) {
        $rules = array(
            'Department'          => 'regex:/^[(a-zA-Z\s)]+$/u|between:2,20|unique:positions,position_name',
            'Description'        => 'between:2,500',
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()) {
            return redirect()->back()
                                ->withErrors($validator)
                                ->withInput(Input::all());
        }   else {
            $data = array(
                'dept_name' => Input::get('Department'),
                'dept_desc' => Input::get('Description'),
            );

            $updates = array('dept_desc' => $data['dept_desc']);
            if($data['dept_name']) {
                $updates = array_add($updates, 'dept_name', $data['dept_name']);
            }

            DB::table('departments')->where('dept_id', $id)->update($updates);
            $request->session()->flash('alert-success', 'Department has been successfully edited!');
            return redirect(url('/department'));
        }
    }

    public function deleteDepartment($id) {
        $details = DB::table('departments')->where('dept_id', $id)->get();
        DB::table('departments')->where('dept_id', $id)->delete();
        return ['dept_name' => $details[0]->dept_name];
    }
}
