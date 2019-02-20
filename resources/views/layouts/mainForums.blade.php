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
            <img class= "groupIcon" src = "{{ asset('svg/meeting.svg')}}"/>
          </div>
        <main class="main">
                <a href="/posts/create" class="add-post-btn-fx"> <span> +</span> </a>

            <aside class="sidebar">

                    <div class= "topicscontent shadow">
                        @foreach($categories as $cat)
                            <div class="topicContainer" id= "topicContainer_{{$cat->id}}">
                                @if( locale() =="en")

                                     <a class="topicTitle" href = "#" id = "Cat_{{$cat->id}}" onclick ="getPosts(this)">{{$cat->bodyen}}</a>
                                @else
                                     <a class="topicTitle" href = "#" id = "Cat_{{$cat->id}}" onclick ="getPosts(this)">{{$cat->bodyar}}</a>
                                @endif

                            </div>
                             <div style = "height:1.5px;background-color:rgb(56, 58, 63);;margin-top:5px; margin-bottom:8px;"></div>
                        @endforeach
                    </div>

                    <div class= "tags shadow">
                        <div class= "lefttags">
                            <h4 class= "tagtitle" >@lang('posts.tags')</h4>
                        </div>
                        <div class="colSeperator"></div>
                        <div class="righttags">
                            @php
                                $i = 0 ;
                            @endphp
                            @foreach($tags as $tag)

                            @if($i <4 )
                                <span class= "p_tagbody" onclick= "getTagPosts({{$tag->id}})">
                                    <a class="tag_body_side" href="#">{{$tag->body}}</a>
                                </span>
                            @else
                                    @php
                                        break;
                                    @endphp
                            @endif
                            @php
                                $i++ ;
                            @endphp
                            @endforeach

                        </div>
                    </div>


                    <div class="addedNow shadow">
                        <span class="recentalert shadow">@lang('posts.recentAdded')</span>
                        <div class= "posts-recent">
                            @foreach($lastPosts as $lastPost)
                                <div class= "post_recent">
                                    <div class="userdata">
                                            <a  href="http://127.0.0.1:8000/profile/{{$lastPost->user->username}}"><img  class="userPhoto" src="{{$lastPost->user->avatar}}" /></a>
                                            <a href="http://127.0.0.1:8000/profile/{{$lastPost->user->username}}" class="username">{{$lastPost->user->name}}</a>
                                    </div>
                                    <div>
                                        <a class="recent-post-title" href="/posts/index/{{$lastPost->id}}" > {{$lastPost->title}} </a>
                                        <div class="postrecent_op">
                                            <img class= "recent-view-icon"  src = "{{ asset('svg/eye.svg')}}"/>
                                            <p class="numofViews">{{ $lastPost->viewsNumber }}</p>
                                            <div class= "recenet_col_sep"></div>
                                            <div class= "date">{{ $lastPost->created_at->format('d')." " . date("M", strtotime($lastPost->created_at)) ." ".$lastPost->created_at->format('y')}}</div>
                                        </div>
                                    </div>
                                </div>
                                <div  class="lineSeperator"></div>
                            @endforeach
                        </div>
                </div>

            </aside>

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
