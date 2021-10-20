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
            <li class="breadcrumb-item active">Edit</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Edit Employee</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('employee.update',$employee) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">Department</label>
                        <select name="department_id" class="form-control @error('department_id') is-invalid @enderror">
                            <option value="">--</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}"
                                @if ($employee->department_id == $department->id)
                                    selected
                                @endif    
                                >{{ $department->name }}</option>
                            @endforeach
                        </select>
                        @error('department_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">First Name</label>
                        <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name',$employee->first_name) }}">
                        @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Last Name</label>
                        <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name',$employee->last_name) }}">
                        @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Gender</label>
                        <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                            @php
                                $array = ['M','F']
                            @endphp
                            <option value="">--</option>
                            @foreach ($array as $gender)
                                <option value="{{$gender }}" 
                                @if ($employee->gender == $gender)
                                    selected
                                @endif>{{ $gender }}</option>
                            @endforeach
                        </select>
                        @error('gender')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="">Position</label>
                        <input type="text" name="position" class="form-control @error('position') is-invalid @enderror" value="{{ old('position',$employee->position) }}">
                        @error('position')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="">Salary</label>
                        <input type="number" name="salary" class="form-control @error('salary') is-invalid @enderror" value="{{ old('salary',$employee->salary) }}">
                        @error('salary')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success"> <i class="fa fa-paper-plane"></i> SAVE CHANGES</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection