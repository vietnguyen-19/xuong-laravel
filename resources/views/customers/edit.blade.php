@extends('master')

@section('title')
    cập nhật khách hàng
@endsection
@section('content')
    <h1>cập nhật khách hàng</h1>

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
        <form action="{{ route('customers.update', $customer) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3 row">
                <label class="col-4 col-form-label">Name</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="name" id="name"
                        value="{{ $customer->name }}" />
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-4 col-form-label">address</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="address" id="address"
                        value="{{ $customer->address }}" />
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-4 col-form-label">email</label>
                <div class="col-8">
                    <input type="email" class="form-control" name="email"
                        id="email"value="{{ $customer->email }}" />
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-4 col-form-label">phone</label>
                <div class="col-8">
                    <input type="tel" class="form-control" name="phone" id="phone"
                        value="{{ $customer->phone }}" />
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-4 col-form-label">is active</label>
                <div class="col-8">
                    <input type="checkbox" value="1" class="form-checkbox" @checked($customer->is_active)
                        name="is_active" id="is_active" />
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-4 col-form-label">avatar</label>
                <div class="col-8">
                    <input type="file" class="form-control" name="avatar" id="address" />
                    @if ($customer->avatar)
                        <img src="{{ Storage::url($customer->avatar) }}" width="100">
                    @endif
                </div>
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
