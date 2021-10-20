@extends('app.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Lihat</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  @if ($message = Session::get('success'))
      <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>    
          <strong>{{ $message }}</strong>
      </div>
    @endif

    <div class="col-md-12">
        
        <div class="card mb-4">
            <div class="card-header">
                Data Salary per Department
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-light d-table">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Department</th>
                                <th>Highest salary</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($hight_salary as $salary)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $salary->name }}</td>
                                <td>Rp.{{ number_format($salary->hight_salary) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
               </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
            <form action="" method="GET ">
                <div class="row">
                    <div class="col-md-5">
                        <label for="">Tanggal</label>
                        <input type="date" name="search" class="form-control" value="{{ request()->search }}">
                    </div>
        
                    <div class="col-md-2">
                        <label for=""></label>
                        <button class="btn btn-success" style="margin-top:32px">SEARCH</button>
                    </div>
                </div>
            </form> 
            </div>
            <div class="card-body">
                <a href="{{ route('employee.create') }}" class="btn btn-success mb-3">+ Create</a>
               <div class="table-responsive">
                <table class="table table-light d-table">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Department</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Gender</th>
                            <th>Position</th>
                            <th>Salary</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @forelse ($employees as $employee)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $employee->department->name }}</td>
                                <td>{{ $employee->first_name }}</td>
                                <td>{{ $employee->last_name }}</td>
                                <td>{{ $employee->gender }}</td>
                                <td>{{ $employee->position }}</td>
                                <td>Rp.{{ number_format($employee->salary) }}</td>
                                <td>
                                    <a class="btn btn-warning" href="{{ route('employee.edit',$employee) }}"> Edit</a>
                                    <form action="{{ route('employee.destroy',$employee) }}" style="display: contents" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">No Data.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
               </div>
            </div>
        </div>

    </div>
</div>
@endsection
