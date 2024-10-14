@extends('master')

@section('title')
    danh sách nhân viên
@endsection
@section('content')
    <h1>danh sách nhân viên</h1>

    <a class="btn btn-success" href="{{ route('employees.create') }}" role="button">thêm mới</a>
    @if (session()->has('success') && session()->get('success'))
        <div class="alert alert-success">
            <ul>
                thao tác thành công
            </ul>
        </div>
    @endif

        <table class="table table-primary">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">first name</th>
                    <th scope="col">last name</th>
                    <th scope="col">email</th>
                    <th scope="col">phone</th>
                    <th scope="col">date of birth</th>
                    <th scope="col">hire date</th>
                    <th scope="col">salary</th>
                    <th scope="col">is active</th>
                    <th scope="col">department </th>
                    <th scope="col">manger</th>
                    <th scope="col">address</th>
                    <th scope="col">profile picture</th>
                    <th scope="col">created at</th>
                    <th scope="col">updated at</th>
                    <th scope="col">action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $employee)
                    <tr>
                        <td>{{ $employee->id }}</td>
                        <td>{{ $employee->first_name }}</td>
                        <td>{{ $employee->last_name }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->phone }}</td>
                        <td>{{ $employee->date_of_birth }}</td>
                        <td>{{ $employee->hire_date }}</td>
                        <td>{{ $employee->salary }}</td>

                        <td>
                            @if ($employee->is_active)
                                <span class="badge bg-primary">yes</span>
                            @else
                                <span class="badge bg-danger">no</span>
                            @endif
                        </td>

                        <td>{{ $employee->department_id }}</td>
                        <td>{{ $employee->manager_id }}</td>
                        <td>{{ $employee->address }}</td>

                        <td>
                            @if ($employee->profile_picture)
                                <img src="{{ Storage::url($employee->profile_picture) }}" width="100">
                            @endif
                        </td>
                        <td>{{ $employee->created_at }}</td>
                        <td>{{ $employee->updated_at }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('employees.show', $employee) }}"
                                role="button">show</a>
                            <a class="btn btn-warning" href="{{ route('employees.edit', $employee) }}"
                                role="button">edit</a>

                            <form action="{{ route('employees.destroy', $employee) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('có chắc chắn xóa không?')"
                                    class="btn btn-danger">
                                    del
                                </button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $data->links() }}

@endsection
