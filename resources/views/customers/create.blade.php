@extends('master')

@section('title')
    thêm mới khách hàng {{ $customer->name }}
@endsection
@section('content')
    <h1>thêm mới khách hàng {{ $customer->name }}</h1>

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
        <form action="{{ route('customers.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 row">
                <label class="col-4 col-form-label">Name</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}"/>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-4 col-form-label">address</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="address" id="address" value="{{ old('address') }}"/>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-4 col-form-label">email</label>
                <div class="col-8">
                    <input type="email" class="form-control" name="email" id="email"value="{{ old('email') }}" />
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-4 col-form-label">phone</label>
                <div class="col-8">
                    <input type="tel" class="form-control" name="phone" id="phone" value="{{ old('phone') }}"/>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-4 col-form-label">is active</label>
                <div class="col-8">
                    <input type="checkbox" value="1" class="form-checkbox" name="is_acvite" id="is_acvite" />
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-4 col-form-label">avatar</label>
                <div class="col-8">
                    <input type="file" class="form-control" name="avatar" id="address" />
                </div>
            </div>

            <div class="mb-3 row">
                <div class="offset-sm-4 col-sm-8">
                    <button type="submit" class="btn btn-primary">
                        tạo mới
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
