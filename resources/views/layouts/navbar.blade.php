<nav class="navbar navbar-app">
    <div class="container dashboard-navbar">
        <a href="{{ route('home') }}" class="navbar-brand-app">
            <img src="/images/gradu-cap.ico" alt="Student Desk Logo" class="brand-logo">
            <span>
                <strong>{{ __('main.nav.brand') }}</strong>
                <small>{{ __('main.nav.brand_subtitle') }}</small>
            </span>
        </a>

        <div class="dashboard-nav">

            @auth

                <span class="dashboard-user">
                    {{ Auth::user()->name }}
                </span>

            @endauth

        </div>

        <div class="dashboard-actions">

            <div class="language-switch">
                <span class="{{ app()->getLocale() == 'id' ? 'active' : '' }}">ID</span>

                <label class="switch">
                    <input type="checkbox" {{ app()->getLocale() == 'en' ? 'checked' : '' }}
                        onchange="window.location.href='{{ app()->getLocale() == 'en' ? route('language.switch', 'id') : route('language.switch', 'en') }}'">

                    <span class="slider"></span>
                </label>

                <span class="{{ app()->getLocale() == 'en' ? 'active' : '' }}">EN</span>
            </div>

            @guest

                <a href="{{ route('login') }}" class="btn btn-light nav-action">
                    {{ __('main.login') }}
                </a>

                <a href="{{ route('register.view') }}" class="btn btn-secondary nav-action">
                    {{ __('main.register') }}
                </a>

            @endguest

            @auth

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-danger nav-action">
                        Logout
                    </button>
                </form>

            @endauth

        </div>
    </div>
</nav>
