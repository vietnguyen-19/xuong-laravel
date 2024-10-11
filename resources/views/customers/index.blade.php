@extends('master')

@section('title')
    danh sách khách hàng
@endsection
@section('content')
    <h1>danh sách khách hàng</h1>

    <a class="btn btn-success" href="{{ route('customers.create') }}" role="button">thêm mới</a>
    @if (session()->has('success') && session()->get('success'))
        <div class="alert alert-success">
            <ul>
                thao tác thành công
            </ul>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-primary">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">name</th>
                    <th scope="col">address</th>
                    <th scope="col">avatar</th>
                    <th scope="col">email</th>
                    <th scope="col">phone</th>
                    <th scope="col">is active</th>
                    <th scope="col">created at</th>
                    <th scope="col">updated at</th>
                    <th scope="col">action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $customer)
                    <tr>
                        <td>{{ $customer->id }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->address }}</td>
                        <td>
                            @if ($customer->avatar)
                                <img src="{{ Storage::url($customer->avatar) }}" width="100">
                            @endif
                        </td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>
                            @if ($customer->is_active)
                                <span class="badge bg-primary">yes</span>
                            @else
                                <span class="badge bg-danger">no</span>
                            @endif
                        </td>
                        <td>{{ $customer->created_at }}</td>
                        <td>{{ $customer->updated_at }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('customers.show', $customer) }}"
                                role="button">show</a>
                            <a class="btn btn-warning" href="{{ route('customers.edit', $customer) }}"
                                role="button">edit</a>

                            <form action="{{ route('customers.destroy', $customer) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('có chắc chắn xóa không?')"
                                    class="btn btn-danger">
                                    SM
                                </button>
                            </form>
                            <form action="{{ route('customers.forceDestroy', $customer) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit" onclick="return confirm('có chắc chắn xóa không?')"
                                    class="btn btn-dark">
                                    SC
                                </button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $data->links() }}
    </div>
@endsection
