<!DOCTYPE html>
<html lang="{{ locale() }}">

@push('css')
    @rtl
    <link rel="stylesheet" href="{{ asset('css/learner/posts/mainForum.rtl.css') }}">
    @else
    <link rel="stylesheet" href="{{ asset('css/learner/posts/mainForum.css') }}">
    @endif
@endpush

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base-url" content="{{ config('app.url') }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> {{ config('app.name') }} </title>

    @rtl
    {!! css('app_rtl') !!}
    @else
    {!! css('app') !!}
    @endif

    <style>
    	.add-post-btn-fx {
	    position: fixed;
	    top: 90%;
	    right: 5%;
	    display: block;
	    z-index: 9999;
	    background-color: #f6b500;
	    width: 60px;
	    height: 60px;
	    border-radius: 300px;
	    text-align: center;
	    text-decoration:none;
	    transition : .4s;

    }
    .add-post-btn-fx:hover {
    text-decoration:none;
     transform: rotate(30deg);
    }
    .add-post-btn-fx span{
    	color: #ffffff;
    	font-size: 45px;
    text-decoration: none;
    position: relative;
    top: -10px;
    }

    </style>
    @stack('css')

</head>
<body class="{{ locale() }}">
    @include('partials.navbar')
    <div style = "height:1px;background-color:#fff;margin-top:5px; margin-bottom:8px;"></div>
    <div id="app" class="">
    <div class="Forums">
             <h1 class="ForumsTitle"> @lang('posts.forums')</h1>

          </div>
        <main class="main">
                <a href="/posts/create" class="add-post-btn-fx"> <span> +</span> </a>


            @yield('content')
        </main>
    </div>


    <script src="/js/app.js"></script>
    <script src="/js/ajax.js"></script>

    @if ($errors->any())
    <script> displayErrors(@json($errors->all())) </script>
    @endif

    @stack('scripts')
</body>

</html>
