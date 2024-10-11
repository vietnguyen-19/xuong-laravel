@extends('bt2.layout.master')

@section('title')
    Tổng doanh thu theo tháng
@endsection

@section('content')
    <h1>Tổng doanh thu theo tháng</h1>
    <table class="table">
        <tr>
            <th>tháng</th>
            <th>doanh thu</th>
        </tr>

        @foreach ($totals as $total)
            <tr>
                <td>{{ $total->month_year }}</td>
                <td>{{ $total->total_sale }}</td>
            </tr>
        @endforeach
    </table>
@endsection
