@extends('layouts.master')

@section('content')

@if($user->hasVerifiedEmail())
<div class="alert py-2 alert-success">
    شما قبلا ایمیل خود را تایید کرده اید.
    <a href="{{ route('user.panel') }}" class="btn ms-2 btn-secondary">برگشت به پنل کاربری</a>
</div>
@else
<div class="alert mb-4 alert-warning">
    شما هنوز ایمیل خود را تایید نکرده اید. لطفا ابتدا به ایمیل خود مراجعه کنید و اگر ایمیلی مبنی بر تایید آدرس ایمیل دریافت نکرده اید.
    با استفاده از این بخش و با کلیک بر روی دکمه زیر میتوانید ایمیل تاییدیه جدید دریافت کنید!
</div>

@if(session('flash_success_message'))
<div class="alert alert-success">
    یک ایمیل تاییدیه جدید به ایمیل شما ارسال شد. لطفا ایمیل خود را چک کنید و نسبت به تایید آدرس ایمیل اقدام کنید.
</div>
@else
<div class="row">
    <div class="col-lg-7 col-md-9">

        <div class="card">
            <div class="card-body">
                <h4 class="mb-4">تایید آدرس ایمیل</h4>

                <form method="POST" action="{{ route('verification.notice') }}">
                    @csrf

                    <div class="mb-3 form-check">
                        <input name="confirm" required class="form-check-input" type="checkbox" id="noticeConfirm">
                        <label class="form-check-label" for="noticeConfirm">ایمیل خود را چک کردم و هیچ ایمیلی مبنی بر تایید آدرس ایمیل دریافت نکرده ام. (کلیک کنید)</label>
                    </div>

                    <button class="btn px-5 btn-primary" type="submit">دریافت ایمیل تاییدیه جدید</button>
                </form>
            </div>
        </div>

    </div>
</div>
@endif

@endif

@endsection
