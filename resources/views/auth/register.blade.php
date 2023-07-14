@extends('layouts.master')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">

        <div class="card">
            <div class="card-body">
                <h4 class="mb-4">ثبت نام در وبلاگ</h4>

                <form method="POST" action="{{ route('auth.register') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="registerFullName" class="form-label">نام کامل</label>
                        <input name="full_name" value="{{ old('full_name') }}" type="text" id="registerFullName" autofocus maxlength="30" class="form-control @error('full_name') is-invalid @enderror" placeholder="نام کامل خود را وارد کنید ...">
                        @error('full_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="registerEmail" class="form-label">آدرس ایمیل</label>
                        <input name="email" value="{{ old('email') }}" type="text" id="registerEmail" maxlength="50" class="form-control @error('email') is-invalid @enderror" placeholder="یک آدرس ایمیل معتبر وارد کنید ...">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="registerUsername" class="form-label">نام کاربری</label>
                        <input name="username" value="{{ old('username') }}" type="text" id="registerUsername" maxlength="20" class="form-control @error('username') is-invalid @enderror" placeholder="یک نام کاربری برای حساب خود وارد کنید ...">
                        @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="registerPassword" class="form-label">رمز عبور</label>
                        <input name="password" type="password" id="registerPassword" maxlength="30" class="form-control @error('password') is-invalid @enderror" placeholder="یک رمز عبور برای حساب خود وارد کنید ...">
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="registerPasswordConfirm" class="form-label">تکرار رمز عبور</label>
                        <input name="password_confirmation" type="password" id="registerPasswordConfirm" maxlength="30" class="form-control" placeholder="تکرار رمز عبور را وارد کنید ...">
                    </div>

                    <button class="btn w-100 btn-primary" type="submit">تایید و ثبت نام</button>
                </form>

                <hr>

                <div>
                    قبلا ثبت نام کرده اید؟
                    <a href="{{ route('auth.login') }}">ورود به حساب کاربری</a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
