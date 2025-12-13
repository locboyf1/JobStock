@extends('content.auth.layout')

@section('title', 'Đăng ký')

@section('content')
    <div class="signup-screen">
        <a href="{{ route('home') }}"><img src="{{ asset('assets/img/logo.png') }}" class="img-responsive" alt=""></a>
        <form action="{{ route('postRegister') }}" method="post" novalidate>
            @csrf
            <input type="text" class="form-control" placeholder="Tên bạn" name="name" value="{{ old('name') }}">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <input type="email" class="form-control" placeholder="Email đăng nhập" name="email"
                value="{{ old('email') }}">
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <input type="text" class="form-control" placeholder="Số điện thoại" name="phone"
                value="{{ old('phone') }}">
            @error('phone')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <input type="password" class="form-control" placeholder="Mật khẩu" name="password">
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <input type="password" name="password_confirmation" class="form-control" placeholder="Nhập lại mật khẩu">
            <button class="btn btn-login" type="submit">Đăng ký</button>
            <span>Bạn đã có tài khoản? <a href="{{ route('login') }}"> Đăng nhập</a></span>
        </form>
    </div>
@endsection
