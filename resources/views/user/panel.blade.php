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
        <div class="mb-3 clearfix">
            <div class="float-start">
                <h4>اعلانات جدید حساب</h4>
            </div>
            <div class="float-end">
                <a href="{{ route('user.notifications') }}" class="btn btn-primary">نمایش همه اعلانات</a>
            </div>
        </div>

        <ul class="list-group">
            @foreach($userUnreadNotifications as $notification)
                @isset($notification->data['message'])
                <li class="list-group-item">
                    {{ $notification->data['message'] }}
                    <form class="d-inline ms-2" method="POST" action="{{ route('user.panel') }}">
                        @csrf
                        <input type="hidden" name="action" value="notification_mark_as_read">
                        <input type="hidden" name="notification_id" value="{{ $notification->id }}">
                        <button class="btn btn-sm btn-primary" type="submit">متوجه شدم</button>
                    </form>
                </li>
                @endisset
            @endforeach
        </ul>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="mb-3 clearfix">
            <div class="float-start">
                <h4>پست های من</h4>
            </div>

            <div class="float-end">
                <a href="{{ route('user.createPost') }}" class="btn btn-primary">ایجاد پست جدید</a>
            </div>
        </div>

        <a href="#" class="btn btn-primary">نمایش همه پست ها</a>
    </div>
</div>
@endsection
