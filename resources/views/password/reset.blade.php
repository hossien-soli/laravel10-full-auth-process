@extends('layouts.master')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">

        <div class="card">
            <div class="card-body">
                <h4 class="mb-4">تنظیم رمز عبور جدید</h4>

                <form method="POST" action="{{ route('password.reset') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    <input type="hidden" name="email" value="{{ $request->email }}">

                    <div class="mb-3">
                        <label for="resetEmail" class="form-label">آدرس ایمیل</label>
                        <input value="{{ $request->email }}" type="text" disabled id="resetEmail" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="resetPassword" class="form-label">رمز عبور جدید</label>
                        <input name="password" type="password" id="resetPassword" autofocus maxlength="30" class="form-control @error('password') is-invalid @enderror" placeholder="یک رمز عبور جدید برای حساب خود وارد کنید ...">
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="resetPasswordConfirm" class="form-label">تکرار رمز عبور جدید</label>
                        <input name="password_confirmation" type="password" id="resetPasswordConfirm" maxlength="30" class="form-control" placeholder="تکرار رمز عبور جدید را وارد کنید ...">
                    </div>

                    <button class="btn btn-primary w-100" type="submit">تایید و تنظیم رمز عبور جدید</button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
