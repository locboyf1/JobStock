@extends('content.auth.layout')

@section('title', 'Đặt lại mật khẩu')

@section('content')
    <div class="signup-screen">
        <a href="{{ route('home') }}"><img src="{{ asset('assets/img/logo.png') }}" class="img-responsive" alt=""></a>
        <form action="{{ route('postResetPassword') }}" method="post" novalidate>
            @csrf
            <input type="hidden" name="email" readonly value="{{ session()->get('reset_password_confirm') }}">
            <input type="text" class="form-control" placeholder="Mã OTP" name="otp" value="{{ old('otp') }}">
            @error('otp')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <button class="btn btn-login" type="submit">Gửi</button>
            <span>Bạn đã nhớ ra mật khẩu? <a href="{{ route('login') }}"> Đăng nhập</a></span>
        </form>
    </div>
@endsection
