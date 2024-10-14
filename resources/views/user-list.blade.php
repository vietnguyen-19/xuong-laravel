@extends('master')


@section('content')
    <h1>danh sách user</h1>

    <div class="table-responsive">
        <table class="table table-primary">
            <thead>
                <tr>
                    <th scope="col">user id</th>
                    <th scope="col">phone</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($data as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->phone->value }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $data->links() }}
    </div>
@endsection
