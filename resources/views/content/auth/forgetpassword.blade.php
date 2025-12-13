@extends('content.auth.layout')

@section('title', 'Quên mật khẩu')

@section('content')
    <div class="signup-screen">
        <a href="{{ route('home') }}"><img src="{{ asset('assets/img/logo.png') }}" class="img-responsive" alt=""></a>
        <form action="{{ route('postForgetPassword') }}" method="post" novalidate>
            @csrf
            <input type="email" class="form-control" placeholder="Email đăng nhập" name="email"
                value="{{ old('email') }}">
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <button class="btn btn-login" type="submit">Gửi</button>
            <span>Bạn đã nhớ ra mật khẩu? <a href="{{ route('login') }}"> Đăng nhập</a></span>
        </form>
    </div>
@endsection
