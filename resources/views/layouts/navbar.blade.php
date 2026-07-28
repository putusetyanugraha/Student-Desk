<nav class="navbar navbar-app">
    <div class="container dashboard-navbar">
        <a href="{{ route('home') }}" class="navbar-brand-app">
            <img src="/images/gradu-cap.ico" alt="Student Desk Logo" class="brand-logo">
            <span>
                <strong>Student Desk</strong>
                <small>Academic dashboard</small>
            </span>
        </a>
        
        <div class="dashboard-nav">
            <a href="{{ route('home') }}"
                class="dashboard-nav__link {{ request()->routeIs('home', 'students.*') ? 'dashboard-nav__link--active' : '' }}">Students</a>
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
            <a href="{{ route('login.view') }}" class="btn btn-light nav-action">{{ __('main.login') }}</a>
            <a href="{{ route('register.view') }}" class="btn btn-secondary nav-action">{{ __('main.register') }}</a>
        </div>
    </div>
</nav>
