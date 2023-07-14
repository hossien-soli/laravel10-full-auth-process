@extends('layouts.master')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">

        <div class="card">
            <div class="card-body">
                <h4 class="mb-3">بازنشانی رمز عبور</h4>

                @if(session('flash_success_message'))
                <div class="alert alert-success">
                    یک لینک بازنشانی رمز عبور به ایمیل شما ارسال شد. میتوانید جهت بازنشانی رمز عبور به ایمیل خود مراجعه کنید!
                </div>
                @else
                <div class="alert alert-info">
                    جهت بازنشانی رمز عبور خود لطفا آدرس ایمیل یا نام کاربری مربوط به حساب خود را وارد کنید تا یک ایمیل بازنشانی دریافت کنید!
                </div>

                <form method="POST" action="{{ route('password.forgot') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="passwordUsernameOrEmail" class="form-label">نام کاربری یا آدرس ایمیل</label>
                        <input name="username_or_email" value="{{ old('username_or_email') }}" autofocus type="text" id="passwordUsernameOrEmail" maxlength="50" class="form-control @error('username_or_email') is-invalid @enderror" placeholder="نام کاربری یا آدرس ایمیل حساب خود را وارد کنید ...">
                        @error('username_or_email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button class="btn btn-primary w-100" type="submit">تایید و ارسال ایمیل بازنشانی</button>
                </form>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection
