@extends('layouts.mainForums')

@push('css')
    @rtl
    <link rel="stylesheet" href="{{ asset('css/learner/posts/mainForum.rtl.css') }}">
    @else
    <link rel="stylesheet" href="{{ asset('css/learner/posts/mainForum.css') }}">
    @endif
@endpush

@section('content')
    <secion class="content">
        <div class="posts">
            @foreach($posts as $post )

            <div class= "Post" onclick="getpostindex({{$post->id}})">
                    <div class="left">
                            <p class= "day">{{ $post->created_at->format('d') }}</p>
                            <p class= "mon">{{  date("M", strtotime($post->created_at)) }} </p>
                            <p class="year"> {{ $post->created_at->format('Y') }} </p>
                            <div class="Post_userdata">
                                    <a href="http://127.0.0.1:8000/profile"><img  class="userPhoto" src="{{$post->user->avatar}}" /></a>
                                    <a href="http://127.0.0.1:8000/profile" class="username">{{$post->user->name}}</a>
                                    <p class="usertype">EDU Specialist</p>
                            </div>


                    </div>
                    <div class="PostcolSeperator"></div>
                    <div class="right">
                            <div class="postContent">
                                <a class="post-title" href="/posts/index/{{$post->id}}">{{$post->title}}</a>
                                <div class= "post-tags">
                                        @foreach($post->tags as $tag)
                                            <span class="post_tagbody"  onclick= "getTagPosts({{$tag->id}})"><a class="tag_body_side" href="#">{{$tag->body}}</a></span>
                                        @endforeach
                                </div>
                                <span class="post-body">
                                    {!! $post->description !!}
                                </span>
                            </div>
                            <div class="post-statistics">
                                    <div class= "post-views">
                                        <img  class="viewsIcon" src = "{{ asset('svg/eye.svg')}}"/>
                                        <p class="views-num">{{$post->viewsNumber}}</p>
                                        <p class="views-word">@lang('posts.views')</p>
                                    </div>
                                    <div class="post-comments">
                                        <img class= "commentsIcon" src = "{{ asset('svg/comments.svg')}}"/>
                                        <p class="comments-num">{{$post->comments->count()}}</p>
                                        <p class="comments-word">@lang('posts.comments')</p>
                                    </div>
                            </div>
                    </div>
            </div>
            @endforeach
        </div>
    </section>
@endsection

<script>
    let cat1 = @json($categories[0]->id);

    function getpostindex(postid){
        let id = postid ;
        window.location = `/posts/index/${id}`;
    }
</script>
@push('scripts')
    <script src="https://cdn.plyr.io/3.4.7/plyr.polyfilled.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.32.2/dist/sweetalert2.all.min.js"></script>
    <script src="{{ asset('js/learners/posts/index.js') }}"></script>
@endpush


