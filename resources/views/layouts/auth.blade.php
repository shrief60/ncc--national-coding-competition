<!doctype html>

<html lang="{{ app()->getLocale() }}">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> {{ config('app.name') }} </title>

    {!! css('app') !!}

    {!! css('auth/auth') !!}

    @stack('css')


</head>

<body class="{{ locale() }}">


    <div id="wrapper">
        <div class="images">
            @for ($i = 1; $i <= 9; $i++)
                <div style='background-image: url({{ img("login/$i", 'jpg') }})'></div>
            @endfor
        </div>
        <div class="overlay"></div>
        <div class="theme-switcher">
            <img src="{{ icon('lamp', 'svg') }}" class="svg">
            <span>turn lights on</span>
        </div>
        <div class="body">
            <div class="header">
                <img src="{{ img('logo') }}" />
                <span> professional developement </span>
            </div>

            <div class="content">
                <div class="left">
                    <div class="toggler">
                        @if(Route::currentRouteName() == 'learner.login')
                        <span> @lang('auth.sign_in') </span>
                        <a href="{{ url('register') }}"> @lang('auth.register') </a>
                        @elseif(Route::currentRouteName() == 'admin.login')
                        <span> @lang('auth.sign_in') </span>
                        <a href="{{ url('admin/register') }}"> @lang('auth.register') </a>
                        @elseif(Route::currentRouteName() == 'learner.register')
                        <a href="{{ url('login') }}"> @lang('auth.sign_in') </a>
                        <span> @lang('auth.register') </span>
                        @elseif(Route::currentRouteName() == 'admin.register')
                        <a href="{{ url('admin/login') }}"> @lang('auth.sign_in') </a>
                        <span> @lang('auth.register') </span>
                        @else
                        <a href="{{ url('login') }}"> @lang('auth.sign_in') </a>
                        <a href="{{ url('register') }}"> @lang('auth.register') </a>
                        @endif
                    </div>
                </div>

                <div class="right">
                    <div class="lang-switcher">
                        <img src="{{ icon('earth-globe', 'svg') }}" class="svg">
                        @rtl
                        <a href="{{ route('locale.switch', 'en') }}">
                            <span> English </span>
                        </a>
                        @else
                        <a href="{{ route('locale.switch', 'ar') }}">
                            <span> عربى </span>
                        </a>
                        @endrtl
                    </a>
                    </div>
                    <div class="form-header">
                        <h3> <span> @lang('auth.welcome.title') </span> @lang('auth.welcome.text') </h3>
                    </div>
                    @yield('form')
                </div>
            </div>
            <div class="footer">
                <div>Powered by <span>uniparticle</span><br> &copy; 2018</div>
            </div>
        </div>
    </div>

    {!! js('app') !!}
    {!! js('ajax') !!}
    <script>
        displayErrors(@json($errors->messages()))
    </script>
    @stack('scripts')

</body>

</html>
