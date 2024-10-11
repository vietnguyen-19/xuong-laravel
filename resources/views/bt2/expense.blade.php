@extends('bt2.layout.master')

@section('title')
    Tổng chi phí theo tháng
@endsection

@section('content')
    <h1>Tổng chi phí theo tháng</h1>
    <table class="table">
        <tr>
            <th>tháng</th>
            <th>chi phí</th>
        </tr>

        @foreach ($expenses as $item)
            <tr>
                <td>{{ $item->month_year }}</td>
                <td>{{ $item->total_expenses }}</td>
            </tr>
        @endforeach
    </table>
@endsection
