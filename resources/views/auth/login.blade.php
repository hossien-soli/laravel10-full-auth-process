@extends('layouts.master')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">

        <div class="card">
            <div class="card-body">
                <h4 class="mb-4">ورود به حساب کاربری</h4>

                <form method="POST" action="{{ route('auth.login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="loginUsernameOrEmail" class="form-label">نام کاربری یا آدرس ایمیل</label>
                        <input name="username_or_email" value="{{ old('username_or_email') }}" type="text" id="loginUsernameOrEmail" autofocus maxlength="50" class="form-control @error('username_or_email') is-invalid @enderror" placeholder="نام کاربری یا آدرس ایمیل خود را وارد کنید ...">
                        @error('username_or_email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="loginPassword" class="form-label">رمز عبور</label>
                        <input name="password" type="password" id="loginPassword" maxlength="30" class="form-control @error('password') is-invalid @enderror" placeholder="رمز عبور حساب خود را وارد کنید ...">
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 form-check">
                        <input name="remember" checked class="form-check-input" type="checkbox" id="loginRememberMe">
                        <label class="form-check-label" for="loginRememberMe">مرا به خاطر بسپار</label>
                    </div>

                    <button class="btn btn-primary w-100" type="submit">تایید و ورود به حساب</button>
                </form>

                <hr>

                <div class="mb-2">
                    هنوز ثبت نام نکرده اید؟
                    <a href="{{ route('auth.register') }}">ثبت نام در وبلاگ</a>
                </div>

                <div>
                    رمز عبور خود را فراموش کرده اید؟
                    <a href="#">بازنشانی رمز عبور</a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
