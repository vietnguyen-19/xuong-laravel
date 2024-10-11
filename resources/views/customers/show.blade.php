@extends('master')

@section('title')
    chi tiết khách hàng {{ $customer->name }}
@endsection
@section('content')
    <h1>chi tiết khách hàng khách hàng {{ $customer->name }}</h1>

    <div class="table-responsive">
        <table class="table table-primary">
            <thead>
                <tr>
                    <th scope="col">tên trường dữ liệu</th>
                    <th scope="col">giá trị</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($customer->toArray() as $key => $value)
                    <tr class="">
                        <td scope="row">{{ strtoupper($key) }}</td>
                        <td>
                            @php
                                switch ($key) {
                                    case 'avatar':
                                        if ($value) {
                                            $url = Storage::url($value);
                                            echo "<img src='$url' width='100'>";
                                        }
                                        break;
                                    case 'is_active':
                                        echo $value
                                            ? "<span class='badge bg-primary'>yes</span>"
                                            : "<span class='badge bg-danger'>no</span>";
                                        break;
                                    default:
                                        echo $value;
                                        break;
                                }
                            @endphp
                        </td>
                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>
@endsection
