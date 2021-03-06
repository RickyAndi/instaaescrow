<nav class="navbar is-white">
    <div class="container">
        <div class="navbar-brand">
            <a class="navbar-item brand-text" href="{{ route('admin.index') }}">
                {{ config('app.name') }}
            </a>
            <div class="navbar-burger burger" data-target="navMenu">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <div id="navMenu" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item" href="admin.html">
                    Home
                </a>
                <a class="navbar-item" href="admin.html">
                    Orders
                </a>
                <a class="navbar-item" href="admin.html">
                    Payments
                </a>
                <a class="navbar-item" href="admin.html">
                    Exceptions
                </a>
                <a class="navbar-item" href="admin.html">
                    Reports
                </a>
                @if(Auth::guard('admin')->check())
                <a href="#">
                    {{ __('label.logout') }}
                </a>
                @endif
            </div>

        </div>
    </div>
</nav>