@extends('layouts.master')

@section('content')

@unless($user->hasVerifiedEmail())
<div class="alert py-2 alert-warning">
    لطفا جهت انتشار پست در وبلاگ ایمیل خود را تایید کنید.
    <a href="{{ route('verification.notice') }}" class="btn btn-success ms-2">تایید ایمیل</a>
</div>
@endunless



@endsection
