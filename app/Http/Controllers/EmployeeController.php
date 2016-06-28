<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use DB, Input, Validator, Redirect, Hash;

class EmployeeController extends Controller
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
            'employee_no' => Input::get('employee_no'),
            'firstname' => Input::get('firstname'),
            'lastname' => Input::get('lastname')
        );

        $conditionalWhere = [];
        if($data['employee_no']) {
            array_push($conditionalWhere, ['employee_no', $data['employee_no']]);
        }   if($data['firstname']) {
            array_push($conditionalWhere, ['firstname', 'like', '%'. $data['firstname'].'%']);
        }   if($data['lastname']) {
            array_push($conditionalWhere, ['lastname', 'like', '%'. $data['lastname'].'%']);
        } 

        $employees = DB::table('users')->where($conditionalWhere)->paginate(5);

        return view('employee', ['employees' => $employees, 'data' => $data]);
    }

    public function viewEmployee($id) {
        $details = DB::table('users')->where('id', $id)
                        ->leftJoin('positions', 'users.position_id', '=', 'positions.position_id')
                        ->leftJoin('departments', 'positions.dept_id', '=', 'departments.dept_id')->get();
        return view('employee_view', ['details' => $details[0]]);
    }

    public function showCreateForm() {
        $positions = DB::table('positions')->get();
        return view('employee_create', ['positions' => $positions]);
    }

    public function postCreate(Request $request) {
        $rules = array(
            'position'          => 'required|',
            'Employee_Number'   => 'required|alpha-dash|between:4,20|unique:users,employee_no',
            'First_Name'        => 'required|regex:/^[(a-zA-Z\s)]+$/u|between:2,32',
            'Last_Name'         => 'required|regex:/^[(a-zA-Z\s)]+$/u|between:2,32',
            'Email_Address'     => 'required|email|unique:users,email',
            'Password'          => 'required|',
            'Confirm_Password'  => 'required|same:Password',
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()) {
            return redirect()->back()
                                ->withErrors($validator)
                                ->withInput(Input::except('Password', 'Confirm_Password'));
        }   else {
            DB::table('users')->insert([
                'position_id'   => Input::get('position'),
                'employee_no'   => Input::get('Employee_Number'),
                'firstname'     => Input::get('First_Name'),
                'lastname'      => Input::get('Last_Name'),
                'email'         => Input::get('Email_Address'),
                'password'      => Hash::make(Input::get('Password')),
                'username'      => Input::get('Email_Address'),
            ]);

            $request->session()->flash('alert-success', 'Employee has been successfully added!');
            return redirect(url('/employee'));
        }
    }

    public function showEditForm($id) {
        $details = DB::table('users')->where('id', $id)->get();
        $positions = DB::table('positions')->get();
        return view('employee_edit', ['details' => $details[0], 'positions' => $positions]);
    }

    public function postEdit(Request $request, $id) {
        $rules = array(
            'position'          => '',
            'Employee_Number'   => 'alpha-dash|between:4,20|unique:users,employee_no',
            'First_Name'        => 'alpha|between:2,32',
            'Last_Name'         => 'alpha|between:2,32',
            'Email_Address'     => 'email|unique:users,email',
            'Password'          => '',
            'Confirm_Password'  => 'same:Password',
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()) {
            return redirect()->back()
                                ->withErrors($validator)
                                ->withInput(Input::except('Password', 'Confirm_Password'));
        }   else {
            $data = array(
                'position_id'   => Input::get('position'),
                'employee_no'   => Input::get('Employee_Number'),
                'firstname'     => Input::get('First_Name'),
                'lastname'      => Input::get('Last_Name'),
                'email'         => Input::get('Email_Address'),
                'password'      => Hash::make(Input::get('Password')),
                'username'      => Input::get('Email_Address'),
            );

            $updates = array('position_id' => $data['position_id']);
            if($data['employee_no']) {
                $updates = array_add($updates, 'employee_no', $data['employee_no']);
            }   if($data['firstname']) {
                $updates = array_add($updates, 'firstname', $data['firstname']);
            }   if($data['lastname']) {
                $updates = array_add($updates, 'lastname', $data['lastname']);
            }   if($data['email']) {
                $updates = array_add($updates, 'email', $data['email']);
                $updates = array_add($updates, 'username', $data['email']);
            }   if($data['password']) {
                $updates = array_add($updates, 'password', $data['password']);
            }

            DB::table('users')->where('id', $id)->update($updates);
            $request->session()->flash('alert-success', 'Employee has been successfully edited!');
            return redirect(url('/employee'));
        }
    }

    public function deleteEmployee($id) {
        $details = DB::table('users')->where('id', $id)->get();
        DB::table('users')->where('id', $id)->delete();
        return [    'employee_no' => $details[0]->employee_no, 
                    'firstname' => $details[0]->firstname, 
                    'lastname' => $details[0]->lastname         ];
    }
}
