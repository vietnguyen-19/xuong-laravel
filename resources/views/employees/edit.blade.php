@extends('master')

@section('title')
    thêm mới nhân viên
@endsection
@section('content')
    <h1>thêm mới nhân viên</h1>

    @if (session()->has('success') && !session()->get('success'))
        <div class="alert alert-danger">
            <ul>
                {{ session()->get('error') }}
            </ul>
        </div>
    @endif
    @if (session()->has('success') && session()->get('success'))
        <div class="alert alert-success">
            <ul>
                thao tác thành công
            </ul>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container">

        <form action="{{ route('employees.update', $employee) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" class="form-control" value="{{ $employee->first_name }}">
            </div>

            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" class="form-control" value="{{ $employee->last_name }}">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $employee->email }}">
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="tel" name="phone" class="form-control" value="{{ $employee->phone }}">
            </div>

            <div class="form-group">
                <label for="date_of_birth">Date of Birth</label>
                <input type="date" name="date_of_birth" class="form-control" value="{{ $employee->date_of_birth }}">
            </div>

            <div class="form-group">
                <label for="hire_date">Hire Date</label>
                <input type="datetime-local" name="hire_date" class="form-control"
                    value="{{ old(
                        'hire_date',
                        isset($employee->hire_date) ? \Carbon\Carbon::parse($employee->hire_date)->format('Y-m-d\TH:i') : '',
                    ) }}">
            </div>

            <div class="form-group">
                <label for="salary">Salary</label>
                <input type="number" name="salary" class="form-control" value="{{ $employee->salary }}">
            </div>

            <div class="mb-3 row">
                <label class="col-4 col-form-label">is active</label>
                <div class="col-8">
                    <input type="checkbox" value="1" class="form-checkbox" @checked( $employee->is_active)
                        name="is_active" id="is_active" />
                </div>
            </div>

            <div class="form-group">
                <label for="department_id">Department</label>
                <select name="department_id" class="form-control" required>
                    <option value=""> Department</option>
                    @foreach ($department as $department)
                        <option value="{{ $department->id }}"
                            {{ old('department_id', isset($employee) ? $employee->department_id : '') == $department->id ? 'selected' : '' }}>
                            {{ $department->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="manager_id">Manager</label>
                <select name="manager_id" class="form-control" required>
                    <option value=""> manager</option>
                    @foreach ($manager as $manager)
                        <option value="{{ $manager->id }}"
                            {{ old('manager_id', isset($employee) ? $employee->department_id : '') == $manager->id ? 'selected' : '' }}>
                            {{ $manager->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <textarea name="address" class="form-control">{{ $employee->address }}</textarea>
            </div>

            <div class="form-group">
                <label for="profile_picture">profile_picture</label>
                <input type="file" name="profile_picture" class="form-control">
                @if ($employee->profile_picture)
                <img src="{{ Storage::url($employee->profile_picture) }}" width="100">
            @endif
            </div>

            <div class="mb-3 row">
                <div class="offset-sm-4 col-sm-8">
                    <button type="submit" class="btn btn-primary">
                        cập nhật
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
