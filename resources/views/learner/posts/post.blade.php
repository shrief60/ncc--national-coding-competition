@extends('layouts.mainForums')
 @push('css')
    @rtl
    <link rel="stylesheet" href="{{ asset('css/learner/posts/post.rtl.css') }}">
    @else
    <link rel="stylesheet" href="{{ asset('css/learner/posts/post.css') }}">
    @endif
@endpush

@section('content')
        <secion class="content">
            <div class="posts">
                    <div class= "Post">
                        <div class="left">
                                <p class= "day">{{ $post->created_at->format('d') }}</p>
                                <p class= "mon">{{  date("M", strtotime($post->created_at)) }} </p>
                                <p class="year"> {{ $post->created_at->format('Y') }} </p>
                                <div class="Post_userdata">
                                        <a  href="http://127.0.0.1:8000/profile/{{$post->user->username}}"><img class="userPhoto" src="{{$post->user->avatar}}" /></a>
                                        <a href="http://127.0.0.1:8000/profile/{{$post->user->username}}" class="username">{{$post->user->name}}</a>
                                        <p class="usertype">EDU Specialist</p>
                                </div>


                        </div>
                        <div class="PostcolSeperator"></div>
                        <div class="right_body">
                                <div class="postContent_index">
                                    <div class= "postheader">
                                        <a class="post-title" href="/posts/index/{{$post->id}}">{{$post->title}}</a>
                                        <div class= "post-tags">
                                                @foreach($post->tags as $tag)
                                                    <span class="post_tagbody">{{$tag->body}}</span>
                                                @endforeach
                                        </div>
                                        <span class="post-body">
                                        {!! $post->body !!}
                                        </span>
                                    </div>
                                    <div class= "right_post" >
                                              <div class="dropleft">

                                                    <img class="Post_barIcon" src = "{{ asset('svg/more.svg')}}" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"/>

                                                    <div class="dropdown-menu">
                                                        <!-- Dropdown menu links -->
                                                        @if(auth()->user()->username ==  $post->user->username)
                                                            <a class="dropdown-item" href="#" id="{{ $post->id}}" onclick="toggle_update_post({{ $post->id }})" >Edit</a>
                                                            <a class="dropdown-item" href="#" id="{{ $post->id}}"onclick =" delete_post({{ $post->id }})" >Delete</a>
                                                        @else
                                                            <a class="dropdown-item" href="#">No Options</a>
                                                        @endif
                                                    </div>
                                                </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="commentsbar">
                        <div class="leftside">
                            <img class= "view-icon" src = "{{ asset('svg/eye.svg')}}"/>
                            <p id ="numofviews">{{$post->viewsNumber}}</p>
                            <?php
                                $user = auth()->user();
                            ?>
                                <svg class="{{$post->islikedBy(auth()->user()) ? 'active_like' : 'native_like'}}" onclick="makeLike({{$post}})"   id="Capa_P{{$post->id}}" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                        viewBox="0 0 492.719 492.719" style="enable-background:new 0 0 492.719 492.719;" xml:space="preserve">
                                    <g>
                                        <g id="Icons_18_">
                                            <path  d="M492.719,166.008c0-73.486-59.573-133.056-133.059-133.056c-47.985,0-89.891,25.484-113.302,63.569
                                                c-23.408-38.085-65.332-63.569-113.316-63.569C59.556,32.952,0,92.522,0,166.008c0,40.009,17.729,75.803,45.671,100.178
                                                l188.545,188.553c3.22,3.22,7.587,5.029,12.142,5.029c4.555,0,8.922-1.809,12.142-5.029l188.545-188.553
                                                C474.988,241.811,492.719,206.017,492.719,166.008z"/>
                                        </g>
                                    </g>

                                </svg>
                                <p id="post_numofloves" class="numofloves">{{$post->likesCount}}</p>
                                <img class = "postcomments-icon" id="Like_{{$post->id}}" src = "{{ asset('svg/comments.svg')}}" />
                            <p  class="numofcomments">{{$comCount}}</p>
                        </div>
                        <div class= "rightside">
                            <img class= "view-icon" src = "{{ asset('svg/facebook.svg')}}"/>
                            <p id ="numofviews">102</p>
                            <img class = "Love-icon" src = "{{ asset('svg/twitter.svg')}}" onclick="makeLike(this)"/>
                            <p class="numofloves">102</p>
                        </div>
                    </div>
                    <div class="comments" >
                        @foreach($post->comments as $comm)
                        <div class= "wholeComment">
                            <div class="comment-container">
                                <div class= "comment">
                                    <div class="left">
                                            <div class="Post_userdata">
                                                <a  href="http://127.0.0.1:8000/profile/{{$comm->user->username}}"><img  class="userPhoto" src="{{$comm->user->avatar}}" /></a>
                                                <a href="http://127.0.0.1:8000/profile/{{$comm->user->username}}" class="username">{{$comm->user->name}}</a>
                                                <p class="usertype">EDU Specialist</p>
                                            </div>
                                    </div>
                                    <div class="right">
                                            <div class="commentContent">
                                                <div >
                                                    <span class="comment-body" id = "comment-body_{{$comm->id}}" >
                                                        {{$comm->body}}
                                                    </span>
                                                    <div  class="comment_form" id= "comment_form_{{$comm->id}}" >
                                                        <form>
                                                            <div class="form-group">
                                                                <input  id="input_{{ $comm->id }}"class= "commect-input-form form-control" type = "text" style="width:90%" value = "{{ $comm->body }}" />
                                                            </div>
                                                            <button class= "comment_input_btn" onclick="update_comm({{ $comm->id }}  )">Edit</button>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="dropleft">

                                                    <img class="barIcon" src = "{{ asset('svg/more.svg')}}" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"/>

                                                    <div class="dropdown-menu">
                                                        <!-- Dropdown menu links -->
                                                         @if(auth()->user()->username ==  $comm->user->username)
                                                            <a class="dropdown-item" href="#" id="{{ $comm->id}}" onclick="toggle_update({{ $comm->id }})" >Edit</a>
                                                            <a class="dropdown-item" href="#" id="{{ $comm->id}}"onclick =" delete_comm(this)" >Delete</a>
                                                        @else
                                                            <a class="dropdown-item" href="#">No Options</a>
                                                        @endif

                                                    </div>
                                                </div>

                                            </div>
                                    </div>
                                </div>
                                <div class="comment-operations">
                                            <p Class="comment_date">{{"  ". $comm->created_at}}</p>
                                            <div class="leftside_comment">
                                                <div class="commentcolSeperator"></div>
                                                <svg class="{{$comm->islikedBy(auth()->user()) ? 'active_like' : 'native_like'}}" onclick="makeCommentLike({{$comm->id}})"   id="Capa_C{{$comm->id}}" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                        viewBox="0 0 492.719 492.719" style="enable-background:new 0 0 492.719 492.719;" xml:space="preserve">
                                                    <g>
                                                        <g id="Icons_18_">
                                                            <path  d="M492.719,166.008c0-73.486-59.573-133.056-133.059-133.056c-47.985,0-89.891,25.484-113.302,63.569
                                                                c-23.408-38.085-65.332-63.569-113.316-63.569C59.556,32.952,0,92.522,0,166.008c0,40.009,17.729,75.803,45.671,100.178
                                                                l188.545,188.553c3.22,3.22,7.587,5.029,12.142,5.029c4.555,0,8.922-1.809,12.142-5.029l188.545-188.553
                                                                C474.988,241.811,492.719,206.017,492.719,166.008z"/>
                                                        </g>
                                                    </g>

                                                </svg>
                                                <p class="numofloves" id= "numofloves_{{$comm->id}}">{{$comm->likesCount}}</p>
                                                <div class="commentcolSeperator"></div>
                                                <img class = "postcomments-icon" src = "{{ getImageIcon('chat') }}" data-toggle="collapse" data-target="#collapseExample{{$comm->id}}" aria-expanded="false" aria-controls="collapseExample{{$comm->id}}"/>
                                                <p class="numofcomments" id ="repliesnum_{{$comm->id}}">{{$comm->replies()->count()}}</p>
                                            </div>
                                </div>
                            </div>
                            <div  class="collapse replies" id="collapseExample{{$comm->id}}">
                                    <div class= "repliesnum">
                                        <div class="repliesname">Replies</div>
                                        <div class="square"></div>
                                        <div class="numofreplies">
                                            <p class="param"> ( </p>
                                            <p id="repliesnumm_{{$comm->id}}"> {{$comm->replies()->count()}} </p>
                                            <p class="param"> ) </p>
                                        </div>
                                    </div>
                                    <div class="replies_data_{{$comm->id}}">
                                        @foreach ($comm->replies as $reply)
                                            <div class= "reply" id = "reply_{{ $reply->id }}">
                                                <div class="reply_userdata">
                                                    <a  href="http://127.0.0.1:8000/profile/{{$reply->user->username}}"><img  class="reply_userPhoto" src="{{$reply->user->avatar}}" /></a>
                                                    <a href="http://127.0.0.1:8000/profile/{{$reply->user->username}}" class="reply_username">{{$reply->user->name}}</a>
                                                    <p class="reply_usertype">Teacher</p>
                                                </div>
                                                <div class="replybody" >
                                                    {{$reply->body}}
                                                    <hr class="lineseperator" />
                                                    <div class= "reply_operations">
                                                        <div class= "reply_opLeft">
                                                            <svg class="{{$reply->islikedBy(auth()->user()) ? 'replyLike-active' : 'replyLike-native'}}" onclick ="makereplyLike({{$reply->id}})" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_r{{$reply->id}}" x="0px" y="0px" width="512px" height="512px" viewBox="0 0 456.814 456.814" style="enable-background:new 0 0 456.814 456.814;" xml:space="preserve">
                                                                <g>
                                                                    <g>
                                                                        <path d="M441.11,252.677c10.468-11.99,15.704-26.169,15.704-42.54c0-14.846-5.432-27.692-16.259-38.547    c-10.849-10.854-23.695-16.278-38.541-16.278h-79.082c0.76-2.664,1.522-4.948,2.282-6.851c0.753-1.903,1.811-3.999,3.138-6.283    c1.328-2.285,2.283-3.999,2.852-5.139c3.425-6.468,6.047-11.801,7.857-15.985c1.807-4.192,3.606-9.9,5.42-17.133    c1.811-7.229,2.711-14.465,2.711-21.698c0-4.566-0.055-8.281-0.145-11.134c-0.089-2.855-0.574-7.139-1.423-12.85    c-0.862-5.708-2.006-10.467-3.43-14.272c-1.43-3.806-3.716-8.092-6.851-12.847c-3.142-4.764-6.947-8.613-11.424-11.565    c-4.476-2.95-10.184-5.424-17.131-7.421c-6.954-1.999-14.801-2.998-23.562-2.998c-4.948,0-9.227,1.809-12.847,5.426    c-3.806,3.806-7.047,8.564-9.709,14.272c-2.666,5.711-4.523,10.66-5.571,14.849c-1.047,4.187-2.238,9.994-3.565,17.415    c-1.719,7.998-2.998,13.752-3.86,17.273c-0.855,3.521-2.525,8.136-4.997,13.845c-2.477,5.713-5.424,10.278-8.851,13.706    c-6.28,6.28-15.891,17.701-28.837,34.259c-9.329,12.18-18.94,23.695-28.837,34.545c-9.899,10.852-17.131,16.466-21.698,16.847    c-4.755,0.38-8.848,2.331-12.275,5.854c-3.427,3.521-5.14,7.662-5.14,12.419v183.01c0,4.949,1.807,9.182,5.424,12.703    c3.615,3.525,7.898,5.38,12.847,5.571c6.661,0.191,21.698,4.374,45.111,12.566c14.654,4.941,26.12,8.706,34.4,11.272    c8.278,2.566,19.849,5.328,34.684,8.282c14.849,2.949,28.551,4.428,41.11,4.428h4.855h21.7h10.276    c25.321-0.38,44.061-7.806,56.247-22.268c11.036-13.135,15.697-30.361,13.99-51.679c7.422-7.042,12.565-15.984,15.416-26.836    c3.231-11.604,3.231-22.74,0-33.397c8.754-11.611,12.847-24.649,12.272-39.115C445.395,268.286,443.971,261.055,441.11,252.677z" />
                                                                        <path d="M100.5,191.864H18.276c-4.952,0-9.235,1.809-12.851,5.426C1.809,200.905,0,205.188,0,210.137v182.732    c0,4.942,1.809,9.227,5.426,12.847c3.619,3.611,7.902,5.421,12.851,5.421H100.5c4.948,0,9.229-1.81,12.847-5.421    c3.616-3.62,5.424-7.904,5.424-12.847V210.137c0-4.949-1.809-9.231-5.424-12.847C109.73,193.672,105.449,191.864,100.5,191.864z     M67.665,369.308c-3.616,3.521-7.898,5.281-12.847,5.281c-5.14,0-9.471-1.76-12.99-5.281c-3.521-3.521-5.281-7.85-5.281-12.99    c0-4.948,1.759-9.232,5.281-12.847c3.52-3.617,7.85-5.428,12.99-5.428c4.949,0,9.231,1.811,12.847,5.428    c3.617,3.614,5.426,7.898,5.426,12.847C73.091,361.458,71.286,365.786,67.665,369.308z"  />
                                                                    </g>
                                                                </g>

                                                            </svg>
                                                            <p class = "LikeNum_r{{$reply->id}}">{{$reply->likesCount}}</p>
                                                        </div>
                                                        <div class= "reply_opright">
                                                            <div class="reply_col_sep"></div>
                                                            <p Class="replydate">{{"  ". $reply->created_at }}</p>

                                                        </div>
                                                    </div>
                                                    <hr class="lineseperator" />
                                                </div>

                                            </div>
                                        @endforeach
                                    </div>
                                    <div>
                                        <form class="addReplyDiv">
                                            @csrf
                                            <div class="AddReplydiv form-group">
                                                <textarea class="AddReply form-control " id = "Reply_{{$comm->id}}" name = "body"   rows="3" placeholder="Add your reply here.." ></textarea>
                                            </div>
                                            <div class="replybtndiv form-group" >
                                               <img class = "AddReplyBtn" src = "{{ asset('svg/Replyadd.svg')}}"  onclick="addreply({{$comm->id}})" >
                                            </div>
                                        </form>
                                    </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="form_comment">
                                <form>
                                    @csrf
                                    <div class="commenttext form-group">
                                        <textarea class="add_comment form-control "  name = "comment" id="commentBody"  rows="3" placeholder="Share your thoughts.." ></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="button" id = "addcommentBtn" class = "addcommentBtn" value="@lang('posts.Addcomment')" onclick="addComment({{$post->id}} , {{ $post->user_id }} )"/>
                                    </div>
                                </form>
                    </div>
            </div>
        </section>
@endsection
<script>
    let cat1 = @json($categories[0]->id);
</script>
@push('js')
    <script src="https://cdn.plyr.io/3.4.7/plyr.polyfilled.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.32.2/dist/sweetalert2.all.min.js"></script>
    <script src="{{ asset('js/learners/posts/index.js') }}"></script>
@endpush
