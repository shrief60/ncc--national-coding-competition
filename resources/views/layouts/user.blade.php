<!doctype html>

<html lang="{{ app()->getLocale() }}">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> {{ config('app.name') }} </title>

    {!! css('app') !!}

    @stack('css')

</head>

<body class="{{ locale() }}">

    @yield('content')

    {!! js('app') !!}

    @stack('scripts')

</body>

</html>
