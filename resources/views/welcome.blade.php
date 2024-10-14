@extends('master')


@section('content')

@if(session('error'))
    <div style="color: red;">
        {{ session('error') }}
    </div>
@endif


<h1>welcome to my website</h1>
@endsection
