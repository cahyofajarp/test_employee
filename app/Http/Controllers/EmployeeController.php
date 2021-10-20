<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $hight_salary = DB::table('employees as tb1')->select('tb1.department_id','tb2.name',DB::raw('max(salary) as hight_salary'))
        ->rightJoin('departments as tb2','tb1.department_id','=','tb2.id')
        ->groupBy('tb1.department_id','tb2.name')
        ->get();

        $employees = Employee::with(['department'])
        ->when($request->search,function($q) use ($request){
            $q->whereDate('created_at',\Carbon\Carbon::parse($request->search)->format('Y-m-d'));
        })
        ->latest()->get();
        
        return view('pages.employee.index',compact(
            'employees',
            'hight_salary'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::latest()->get();

        return view('pages.employee.create',compact(
            'departments'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'department_id' => 'required|exists:departments,id',
            'first_name'    => 'required',
            'last_name'     => 'required',
            'gender'        => 'required',
            'position'        => 'required',
            'salary'        => 'required',
        ]);
        
        $data = $request->all();
        $check = Employee::create($data);

        if($check){
            return redirect()->route('employee.index')->with('success','Sukses menambahkan Employee');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $departments = Department::latest()->get();
        return view('pages.employee.edit',compact('employee','departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $this->validate($request,[
            'department_id' => 'required|exists:departments,id',
            'first_name'    => 'required',
            'last_name'     => 'required',
            'gender'        => 'required',
            'position'      => 'required',
            'salary'        => 'required',
        ]);
        
        $data = $request->all();
        $check = $employee->update($data);

        if($check){
            return redirect()->route('employee.index')->with('success','Sukses mengubah Employee');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        if($employee){
            $employee->delete();     
            return redirect()->route('employee.index')->with('success','Sukses menghapus Employee');
        
        }

    }
}
