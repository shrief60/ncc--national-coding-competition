<!DOCTYPE html>
<html lang="{{ locale() }}">

@push('css') @rtl
<link rel="stylesheet" href="{{ asset('css/learner/posts/mainForum.rtl.css') }}"> @else
<link rel="stylesheet" href="{{ asset('css/learner/posts/mainForum.css') }}"> @endif

<link rel="stylesheet" href="{{ asset('css/learner/rounds/round1.css') }}">
@endpush

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base-url" content="{{ config('app.url') }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> {{ config('app.name') }} </title>

    @rtl {!! css('app_rtl') !!} @else {!! css('app') !!} @endif @stack('css')

</head>

<body class="{{ locale() }}" style="background-color:#fff;">

    <div style="height:1px;background-color:#fff;margin-top:5px; margin-bottom:8px;"></div>
    <div id="app" class="">
        <div class="Forums">
            <h1 class="ForumsTitle"> @lang('posts.forums')</h1>

        </div>
        <main class="main">
            <a href="/posts/create" class="add-post-btn-fx"> <span> Add </span> </a> @yield('content')
        </main>
    </div>

    <div class="main_round">
        <div class="round1">
            <div class="round_left">
                <h2 class="ideaHeader"> APP IDEA #1 </h2>
                <p class="ideaDescription"> Create an app to show how different creatures eat different food in a food chain </p>

            </div>
            <div class="round_right">
                <img class="image_round" src="https://previews.123rf.com/images/baz777/baz7771108/baz777110800013/10403555-cartoon-computer-being-scared-by-the-mouse-isolated-on-white-background.jpg"
                    alt="">

            </div>

        </div>

        <div class="op_card">
            <img CLASS="image_card" src="https://previews.123rf.com/images/baz777/baz7771108/baz777110800013/10403555-cartoon-computer-being-scared-by-the-mouse-isolated-on-white-background.jpg"
                alt="">
            <p class="black_section"> WRITE YOUR CODE <span class="blue_section"> > </span> </p>
        </div>
    </div>

    <script src="/js/app.js"></script>
    <script src="/js/ajax.js"></script>

    @if ($errors->any())
    <script>
        displayErrors(@json($errors->all()))
    </script>
    @endif @stack('scripts')
</body>

</html>
