<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Masteritem;
use App\Models\Masterkaryawan;
use App\Models\Masterlokasi;
use App\Models\Transaksiproduct;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $employeeCount = Employee::count();
        $departCount = Department::with(['employees'])->get();
        // $departmentIT = Employee::where('');
        return view('pages.dashboard.index',compact(
            'employeeCount',
            'departCount'
        ));
    }
}
