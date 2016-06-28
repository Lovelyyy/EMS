<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use DB, Input, Validator, Redirect, Hash;

class PositionController extends Controller
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
        $data = array(
            'position' => Input::get('position'),
            'department' => Input::get('department'),
        );

        $conditionalWhere = [];
        if($data['position']) {
            array_push($conditionalWhere, ['position_name', 'like', '%'. $data['position'].'%']);
        }   if($data['department']) {
            array_push($conditionalWhere, ['dept_name', 'like', '%'. $data['department'].'%']);
        }

        $positions = DB::table('positions')
                        ->leftJoin('departments', 'positions.dept_id', '=', 'departments.dept_id')
                        ->where($conditionalWhere)->paginate(5);
        return view('position', ['positions' => $positions, 'data' => $data]);
    }

    public function viewPosition($id) {
        $details = DB::table('positions')->where('position_id', $id)
                        ->leftJoin('departments', 'positions.dept_id', '=', 'departments.dept_id')->get();
        return view('position_view', ['details' => $details[0]]);
    }

    public function showCreateForm() {
        $departments = DB::table('departments')->get();
        return view('position_create', ['departments' => $departments]);
    }

    public function postCreate(Request $request) {
        $rules = array(
            'department'        => 'required|',
            'Position'          => 'required|regex:/^[(a-zA-Z\s)]+$/u|between:2,20|unique:positions,position_name',
            'Description'        => 'required|between:2,500',
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput(Input::all());
        }   else {
            DB::table('positions')->insert([
                'dept_id'       => Input::get('department'),
                'position_name' => Input::get('Position'),
                'position_desc' => Input::get('Description'),
            ]);

            $request->session()->flash('alert-success', 'Position has been successfully added!');
            return redirect(url('/position'));
        }
    }

    public function showEditForm($id) {
        $details = DB::table('positions')->where('position_id', $id)->get();
        $departments = DB::table('departments')->get();
        return view('position_edit', ['details' => $details[0], 'departments' => $departments]);
    }

    public function postEdit(Request $request, $id) {
        $rules = array(
            'department'        => '',
            'Position'          => 'regex:/^[(a-zA-Z\s)]+$/u|between:2,20|unique:positions,position_name',
            'Description'        => 'between:2,500',
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()) {
            return redirect()->back()
                                ->withErrors($validator)
                                ->withInput(Input::all());
        }   else {
            $data = array(
                'dept_id'       => Input::get('department'),
                'position_name' => Input::get('Position'),
                'position_desc' => Input::get('Description'),
            );

            $updates = array('dept_id' => $data['dept_id'], 'position_desc' => $data['position_desc']);
            if($data['position_name']) {
                $updates = array_add($updates, 'position_name', $data['position_name']);
            }

            DB::table('positions')->where('position_id', $id)->update($updates);
            $request->session()->flash('alert-success', 'Position has been successfully edited!');
            return redirect(url('/position'));
        }
    }

    public function deletePosition($id) {
        $details = DB::table('positions')
                        ->leftJoin('departments', 'positions.dept_id', '=', 'departments.dept_id')
                        ->where('position_id', $id)->get();
        DB::table('positions')->where('position_id', $id)->delete();
        return [    'position_name' => $details[0]->position_name, 
                    'dept_name' => $details[0]->dept_name,              ];
    }
}
