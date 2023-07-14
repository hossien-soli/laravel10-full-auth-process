
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="{{ route('main.home') }}">{{ config('custom.app_title') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('main.home') }}">خانه</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">پست ها</a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        حساب کاربری
                    </a>

                    @auth
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="{{ route('user.panel') }}">حساب کاربری</a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="#">پست های من</a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="#">ویرایش پروفایل</a>
                        </li>

                        <li><hr class="dropdown-divider"></li>

                        <li><a class="dropdown-item" onclick="document.getElementById('logoutForm').submit();" href="javascript:;">خروج</a></li>
                    </ul>
                    @else
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="{{ route('auth.login') }}">ورود</a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="{{ route('auth.register') }}">ثبت نام</a>
                        </li>
                    </ul>
                    @endauth
                </li>
            </ul>
        </div>
    </div>
</nav>

@auth
<form id="logoutForm" method="POST" action="{{ route('user.logout') }}">
    @csrf
</form>
@endauth
