@extends('layouts.master')

@section('content')

@unless($user->hasVerifiedEmail())
<div class="alert py-2 alert-warning">
    لطفا جهت انتشار پست در وبلاگ ایمیل خود را تایید کنید.
    <a href="{{ route('verification.notice') }}" class="btn btn-success ms-2">تایید ایمیل</a>
</div>
@endunless

<h4 class="mb-4">
    <span class="badge bg-secondary">{{ $user->full_name }}</span>
     خوش آمدید!
</h4>

<div class="mb-4 card">
    <div class="card-body">
        <h4 class="mb-4">اعلانات حساب</h4>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h4 class="mb-4">پست های من</h4>

        <a href="#" class="btn btn-primary">نمایش همه پست ها</a>
    </div>
</div>
@endsection
