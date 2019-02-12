<nav class="navbar navbar-expand" id="main-navbar">
    <a class="navbar-brand" href="{{ url('/') }}">
        <img style="height: 40px;" src="http://uniparticle.com/delogo.png" > <span style="position: absolute;
    bottom: 15%;
    color: #ffffff;
    font-size: 15px;
    letter-spacing: 2px;
    text-decoration: none !important;">BETA</spna>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false"
        aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

    <div class="collapse navbar-collapse" id="navbar">


    </div>
</nav>

@if (auth()->check())
<!-- Modal -->
<div class="modal fade" id="friend-request-modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">FRIENDS REQUESTS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
            </div>
            <div class="modal-body">
                <p class="requestmessage"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



    @if ($errors->any())
    <script> displayErrors(@json($errors->all())) </script>
    @endif



@push('scripts')


    <script>
        let id = @json(auth()->user()->id);
        let user = @json(auth()->user()->name);
        let avatar = @json(auth()->user()->avatar);
        let username = @json(auth()->user()->username);
        let email = @json(auth()->user()->email);
    </script>
    <script src="{{asset('js/friends/quests.js')}}"></script>
     <script src="{{asset('js/friends/sendrequest.js')}}"></script>

    <script src="{{asset('js/friends/acceptfriens.js')}}"></script>
    <script src="{{asset('js/friends/ignore.js')}}"></script>
    <script src="{{asset('js/friends/navparquests.js')}}"></script>
<script>
    let assetpath = @json(asset(''));
    console.log(assetpath);
    //let user = @json(auth()->user());
    let userid = @json(auth()->user()->id);
    //let username = @json(auth()->user()->username);
    //let avatar = @json(auth()->user()->avatar);

</script>
<script>
        /*console.log("habb");
        fixLink = function(e){
            //comment
            if(e.type == "CTP"){
                if(e.Comment.commentable_type == "App\\Post")
                    return `<a class="dropdown-item" style="background-color:#828a9d" onclick = "marknotification(${"'" +e.notificationid +"'"})" href="{{ url('/posts/index/${e.Comment.commentable_id}') }}" > ${e.loginUser.name} Comments on your Post ${e.Comment.commentable_id}</a>`;
                else
                    return `<a class="dropdown-item" style="background-color:#828a9d" onclick = "marknotification(${"'" +e.notificationid +"'"})" href="{{ url('evidences/show/${e.Comment.commentable_id}') }}" > ${e.loginUser.name} Comments on your Post ${e.Comment.commentable_id}</a>`;

            }
            if(e.type == "LTP"){
                if(e.post.likes_counter.likeable_type == "App\\Post")
                    return `<a class="dropdown-item" style="background-color:#828a9d"  onclick = "marknotification(${"'"+e.notificationid +"'"})" href="{{ url('posts/index/${e.post.id}') }}" > ${e.loginUser.name} Likes your Post ${e.post.id}</a>`;
                else if (e.post.likes_counter.likeable_type == "App\\Evidence")
                    return `<a class="dropdown-item" style="background-color:#828a9d"  onclick = "marknotification(${"'"+e.notificationid +"'"})" href="{{ url('evidences/show/${e.post.id}') }}" > ${e.loginUser.name} Likes your Post ${e.post.id}</a>`

            }
        }

        Echo.channel('notification')
        .listen('CommentedToPostNotification', (e) => {
            console.log(e);
            if(userid == e.notifiedUser.id){
                let parent = $('#dropdown');
                let child = fixLink(e);

                console.log(child);
                parent.prepend(child);
                let val = 1;
                if($("#not_num").text() != "")
                    val =parseInt($("#not_num").text() )+1  ;
                console.log(val);
                $("#not_num").css({"background-color":"#d5201b"});
                $("#not_num").css({"color":"#ffffff"});
                $("#not_num").text(val);
            }

        });
        Echo.channel('notification')
        .listen('LikedToPostNotification', (e) => {
            console.log(e);
            if(userid == e.notifiedUser.id){
                let parent = $('#dropdown');
                let child = fixLink(e);

                console.log(child);
                parent.prepend(child);

                let val = 1;
                if($("#not_num").text() != "")
                    val =parseInt($("#not_num").text() )+1  ;
                console.log(val);
                $("#not_num").css({"background-color":"#d5201b"});
                $("#not_num").css({"color":"#ffffff"});
                $("#not_num").text(val);
            }
        });
        Echo.channel('notification')
        .listen('LikedToCommentNotification', (e) => {
            console.log(e);
            if(userid == e.notifiedUser.id){
                let parent = $('#dropdown');
                let child = `<a class="dropdown-item" style="background-color:#828a9d"  onclick = "marknotification(${"'"+e.notificationid+"'"})" href="{{ url('posts/index/${e.Comment.commentable_id}') }}" > ${e.loginUser.name} Likes your Comment ${e.Comment.id}</a>`;
                parent.prepend(child);

                let val = 1;
                if($("#not_num").text() != "")
                    val =parseInt($("#not_num").text() )+1  ;
                console.log(val);
                $("#not_num").css({"background-color":"#d5201b"});
                $("#not_num").css({"color":"#ffffff"});
                $("#not_num").text(val);
            }
        });
        Echo.channel('notification')
        .listen('LikedToReplyNotification', (e) => {
            console.log(e);
            if(userid == e.notifiedUser.id){
                let parent = $('#dropdown');
                let child = `<a class="dropdown-item" style="background-color:#828a9d" onclick = "marknotification(${"'" +e.notificationid +"'"})" href="{{ url('posts/index/${e.postid}') }}"  > ${e.loginUser.name} Likes your Reply ${e.reply.id}</a>`;
                parent.prepend(child);
                let val = 1;
                if($("#not_num").text() != "")
                    val =parseInt($("#not_num").text() )+1  ;
                console.log(val);
                $("#not_num").css({"background-color":"#d5201b"});
                $("#not_num").css({"color":"#ffffff"});
                $("#not_num").text(val);
            }
        });
        Echo.channel('notification')
        .listen('RepliedToCommentNotification', (e) => {
            console.log(e);
            if(userid == e.notifiedUser.id){
                let parent = $('#dropdown');
                let child = `<a class="dropdown-item" style="background-color:#828a9d" onclick = "marknotification(${"'"+e.notificationid +"'"})" href="{{ url('posts/index/${e.postid}') }}" > ${e.loginUser.name} Replys to Your comment ${e.reply.comment_id}</a>`;
                parent.prepend(child);
                let val = 1;
                if($("#not_num").text() != "")
                    val =parseInt($("#not_num").text() )+1  ;
                console.log(val);
                $("#not_num").css({"background-color":"#d5201b"});
                $("#not_num").css({"color":"#ffffff"});
                $("#not_num").text(val);
            }
        });
        function marknotification(notificationId){
            //console.log(notificationId);
            //console.log($('meta[name="csrf-token"]').attr('content'));
            var formdata = {
                    "id"     : notificationId ,
                };

                    $.ajax({
                        headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "/notificationread",
                        method: 'POST',
                        data: formdata,
                        dataType    : 'json',
                        encode          : true,
                        success: function (response) {
                            console.log(response);
                        },
                        error: function(xhr, textStatus, thrownError) {
                                   // alert(thrownError);
                        }
                    });
        }
        console.log('App.Learner.' + userid);*/
       /* Echo.private('App.Learner.' + userid)
         .notification((notification) => {
             console.log("ffff");
           console.log(notification);
        });*/
</script>


@endpush
@endif
@push('css')
<style>
    #numberquests {
        margin-left: 27px;
        margin-top: -22px;
        background-color: red;
        border-radius: 10px;
        color: white;
        width: 14px;
    }
</style>
@endpush
