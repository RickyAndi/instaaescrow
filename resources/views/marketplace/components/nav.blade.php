<nav class="navbar has-background-black" role="navigation" aria-label="main navigation">

    <div class="navbar-brand">
        <a class="navbar-item" href="{{ route('marketplace.index') }}">
            <h2 class="title is-2 has-text-white">{{ config('app.name') }}</h3>
        </a>

        <a role="button" class="navbar-burger has-text-white" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-end">
            <div class="navbar-item">
                <div class="buttons">
                    @if(!Auth::guard('web')->check())
                    <button id="navbar-login-button" class="button is-info">
                        {{ __('label.login') }}
                    </button>
                    
                    @if(!App::environment('production'))
                    <a id="navbar-login-button" href="{{ route('development.login') }}" class="button is-info">
                        {{ __('label.login') }} development
                    </a>
                    @endif
                    
                    @else
                    <a href="{{ route('marketplace.logout') }}" class="button is-danger">
                        {{ __('label.logout') }}
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</nav>

@push('after-script')
<script>
    @if(!Auth::guard('web')->check())
    document.getElementById('navbar-login-button').addEventListener('click', () => {
        document.getElementById('login-modal').classList.toggle('is-active');  
    });
    @endif
</script>
@endpush