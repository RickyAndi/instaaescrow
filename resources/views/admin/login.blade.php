<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Free Bulma template</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <!-- Bulma Version 0.9.0-->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
</head>

<body>

    <!-- START NAV -->
    <nav class="navbar is-white">
        <div class="container">
            <div class="navbar-brand">
                <a class="navbar-item brand-text" href="../index.html">
                    {{ config('app.name') }}
                </a>
                <div class="navbar-burger burger" data-target="navMenu">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
    </nav>
    <div class="columns is-centered">
        <div class="column is-one-third">
            @if(session(\App\Enums\SessionEnum::SUCCESS))
            <div class="notification is-primary">
                <button class="delete"></button>
                {{ session(\App\Enums\SessionEnum::SUCCESS) }}
            </div>
            @endif

            @if(session(\App\Enums\SessionEnum::FAILED))
                <div class="notification is-danger">
                    <button class="delete"></button>
                    {{ session(\App\Enums\SessionEnum::FAILED) }}
                </div>
            @endif

            <div class="box">
                <form action="{{ route('admin.login') }}" method="POST">
                    @csrf
                    <div class="field">
                        <label class="label">{{ __('label.email') }}</label>
                        <div class="control">
                            <input name="email" class="input @if($errors->has('email')) is-danger @endif" type="email" placeholder="Email input" value="{{ old('email') }}">
                        </div>
                        @if($errors->has('email'))
                        <p class="help is-danger">{{ $errors->first('email') }}</p>
                        @endif
                    </div>

                    <div class="field">
                        <label class="label">{{ __('label.password') }}</label>
                        <div class="control">
                            <input name="password" class="input @if($errors->has('password')) is-danger @endif"" type="password" placeholder="********">
                        </div>
                        @if($errors->has('password'))
                        <p class="help is-danger">{{ $errors->first('password') }}</p>
                        @endif
                    </div>

                    <button class="button is-primary">{{ __('label.sign_in') }}</button>
                </form>
            </div>
        </div>
    </div>
    <script async type="text/javascript" src="{{ asset('js/admin.js') }}"></script>
</body>

</html>
