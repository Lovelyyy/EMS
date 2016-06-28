<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $deptCount = DB::table('departments')->count();
        $userCount = DB::table('users')->count();
        $positionCount = DB::table('positions')->count();
        return view('dashboard', ['dept' => $deptCount, 'user' => $userCount, 'position' => $positionCount]);
    }
}
