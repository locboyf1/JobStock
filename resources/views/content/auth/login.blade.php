@extends('content.auth.layout')
@section('title', 'Đăng nhập')
@section('content')
    <div class="login-screen">
        <a href="{{ route('home') }}"><img src="{{ asset('assets/img/logo.png') }}" class="img-responsive" alt=""></a>
        <form action="{{ route('postLogin') }}" method="post" novalidate>
            @csrf
            <input type="email" class="form-control" placeholder="Email" name="email">
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <input type="password" class="form-control" placeholder="Mật khẩu" name="password">
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <button class="btn btn-login" type="submit">Đăng nhập</button>
            <span>Bạn chưa có tài khoản? <a href="{{ route('register') }}"> Tạo mới ngay</a></span>
            <span><a href="{{ route('forgetPassword') }}"> Quên mật khẩu?</a></span>
        </form>
    </div>
@endsection
