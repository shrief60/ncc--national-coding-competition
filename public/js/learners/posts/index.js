
let beforeid = "";
let beforeContainer = "" ;

$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
function getPosts(cat){
    console.log(cat.id);
    let parts = cat.id.split("Cat_") ;
    let category_id = parts[1];
    let idAtrr = '#'+cat.id;
    let conAtrr = '#topicContainer_'+parts[1];
    let eyeicon = assetpath+"svg/eye.svg";
    let commentsicon = assetpath + "svg/comments.svg";
    $.ajax({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    },
    url    : `/posts/${category_id}`,
    method : 'GET',
    encode : true,
    success: function (response) {
        console.log(response['posts'].length);
            let posts = $('.posts') ;
            $('.posts').empty();
        if (response['posts'].length > 0) {
            let counter = 0;
            $.each(response['posts'], function (i, value) {

                let post = value;
                var date = new Date(post.created_at);
                var month = getMon(date.getMonth());
                var day = date.getUTCDate();
                var year = date.getFullYear();
                let tags = post.tags;
                console.log(tags);
                counter++;
                var posts = $('.posts');
                var postchild = `<div class= "Post" onclick="getpostindex(${post.id})">
                            <div class="left">
                                    <p class= "day">${day}</p>
                                    <p class= "mon">${ month} </p>
                                    <p class="year"> ${year} </p>
                                    <div class="Post_userdata">
                                            <a href="http://127.0.0.1:8000/profile"><img  class="userPhoto" src="${post.learner.avatar}" /></a>
                                            <a  href="http://127.0.0.1:8000/profile" class="username">${post.learner.name}</a>
                                            <p class="usertype">EDU Specialist</p>
                                    </div>
                            </div>
                            <div class="PostcolSeperator"></div>
                            <div class="right">
                                    <div class="postContent">
                                        <a class="post-title" href="/posts/index/${post.id}">${post.title}</a>
                                        <div class= "post-tags">
                                            ${myfunction(tags)}
                                        </div>
                                        <span class="post-body">
                                            ${post.shortbody}
                                        </span>
                                    </div>
                                    <div class="post-statistics">
                                            <div class= "post-views">
                                                <img  class="viewsIcon" src = '${eyeicon}'/>
                                                    <p class="views-num">${post.viewsNumber}</p>
                                                <p class="views-word">views</p>
                                            </div>
                                            <div class="post-comments">
                                                <img class= "commentsIcon" src = '${commentsicon}'/>
                                                <p class="comments-num">${post.comments.length}</p>
                                                <p class="comments-word">Comments</p>
                                            </div>
                                    </div>
                            </div>
                        </div>`;
                posts.append(postchild);

            });
        } else {
            let child = "<div class='no_posts'> NO Posts In This Category</div>";
            posts.append(child);
        }

                $(beforeid).toggleClass("topicTitle topic-Active" );
                $(beforeContainer).toggleClass("topicContainer topicContainer-active");
                $(idAtrr).toggleClass("topicTitle topic-Active" );
                $(conAtrr).toggleClass("topicContainer topicContainer-active");
                beforeid = idAtrr ;
                beforeContainer = conAtrr ;

        },
    error: function(xhr, textStatus, thrownError) {
                alert(thrownError);
        }
    });
}
function getTagPosts(tag_id){
    let tag = tag_id ;
    let eyeicon = assetpath+"svg/eye.svg";
    let commentsicon = assetpath + "svg/comments.svg";
    $.ajax({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    },
    url    : `/posts/tag/${tag}`,
    method : 'GET',
    encode : true,
    success: function (response) {
           console.log(response['posts']);

            let posts = $('.posts') ;
            $('.posts').empty();
            let counter = 0 ;
            $.each(response['posts'] , function (i ,  value){

                let post =value;
                var date = new Date(post.created_at);
                var month = getMon(date.getMonth());
                var day = date.getUTCDate();
                var year = date.getFullYear();
                let tags = post.tags;
               // console.log(tags);
                counter++;
               var posts =  $('.posts') ;
                var postchild = `<div class= "Post" onclick="getpostindex(${post.id})">
                            <div class="left">
                                    <p class= "day">${day}</p>
                                    <p class= "mon">${ month } </p>
                                    <p class="year"> ${year } </p>
                                    <div class="Post_userdata">
                                            <a href="http://127.0.0.1:8000/profile"><img  class="userPhoto" src="${post.learner.avatar}" /></a>
                                            <a  href="http://127.0.0.1:8000/profile" class="username">${post.learner.name}</a>
                                            <p class="usertype">EDU Specialist</p>
                                    </div>
                            </div>
                            <div class="PostcolSeperator"></div>
                            <div class="right">
                                    <div class="postContent">
                                        <a class="post-title" href="/posts/index/${post.id}">${post.title}</a>
                                        <div class= "post-tags">
                                            ${myfunction(tags)}
                                        </div>
                                        <span class="post-body">
                                            ${post.shortbody}
                                        </span>
                                    </div>
                                    <div class="post-statistics">
                                            <div class= "post-views">
                                                <img  class="viewsIcon" src = '${eyeicon}'/>
                                                    <p class="views-num">${post.viewsNumber}</p>
                                                <p class="views-word">views</p>
                                            </div>
                                            <div class="post-comments">
                                                <img class= "commentsIcon" src = '${commentsicon}'/>
                                                <p class="comments-num">${post.comments.length}</p>
                                                <p class="comments-word">Comments</p>
                                            </div>
                                    </div>
                            </div>
                        </div>`;
               posts.append(postchild);
            });
        },
    error: function(xhr, textStatus, thrownError) {
                alert(thrownError);
        }
    });
}
function  getMon(mon){
    var month = new Array();
   // console.log(mon);
    month[0] = "Jan";
    month[1] = "Feb";
    month[2] = "Mar";
    month[3] = "Apr";
    month[4] = "May";
    month[5] = "June";
    month[6] = "July";
    month[7] = "AUG";
    month[8] = "SEPT";
    month[9] = "OCT";
    month[10] = "NOV";
    month[11] = "DEC";
    return month[mon] ;
}
function myfunction(tags){
    let newtags="";
    for(var index in tags) {
        newtags += "<span class='post_tagbody'>"+tags[index].body+"</span>";
    }
     return newtags ;
}
function makeLike(post){
    console.log(post);
    let postId = post.id ;
    console.log(postId);
    postidtext = "Capa_P"+postId ;
    let postIcon = document.getElementById(postidtext);
    if($(postIcon).hasClass('native_like'))
    {
        storeLike(postId);
        liked= true ;
        let res  =$('#post_numofloves').text() ;
        console.log(res);
        res =  parseInt(res)+1 ;
        console.log("res"+res);
        $("#post_numofloves").html(res)  ;
    }
    else
    {
        removeLike(postId);
        liked =false;
        let res  =$('#post_numofloves').text();
        console.log(res);
        res =  parseInt(res) -1 ;
        $("#post_numofloves").html(res)  ;
    }
    $(postIcon).toggleClass("native_like active_like" );
}
function storeLike(postId){
    let id = postId ;
    var formdata = {
            "id"     : id
        };

        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            url: "/postslike",
            method: 'POST',
            data: formdata,
            dataType    : 'json',
            encode          : true,
            success: function (response) {
                    console.log(response);
                    },
            error: function(xhr, textStatus, thrownError) {
                        alert(thrownError);
                    }
        });

}
function removeLike(postId){

    let id =postId;
    var formdata = {
            "id"     : id
        };

        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            url: "/postsremovelike",
            method: 'POST',
            data: formdata,
            dataType    : 'json',
            encode          : true,
            success: function (response) {
                    console.log(response);
                    },
            error: function(xhr, textStatus, thrownError) {
                        alert(thrownError);
                    }
        });
}
function makeCommentLike(commid){
    let commId = commid ;
    let idtext = "Capa_C"+commId;
    let tagname = "#numofloves_"+commId;
    let res = "" ;
    let commlikeIcon = document.getElementById(idtext);
    if($(commlikeIcon).hasClass('native_like'))
    {
        storeCommentLike(commId);
        res  =$(tagname).text() ;
        console.log(res);
        res =  parseInt(res)+1 ;
        console.log("res"+res);
    }
    else
    {
        removeCommentLike(commId);
        res  =$(tagname).text() ;
        console.log(res);
        res =  parseInt(res)-1 ;
        console.log("res"+res);
    }
    $(commlikeIcon).toggleClass("native_like active_like" );
    $(tagname).html(res)  ;
}
function storeCommentLike(commId){
    let id = commId ;
    var formdata = {
            "id"     : id
        };

        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            url: "/commentslike",
            method: 'POST',
            data: formdata,
            dataType    : 'json',
            encode          : true,
            success: function (response) {
                    console.log(response);
                    },
            error: function(xhr, textStatus, thrownError) {
                        alert(thrownError);
                    }
        });

}
function removeCommentLike(commId){

    let id =commId;
    var formdata = {
            "id"     : id
        };

        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            url: "/commentsremovelike",
            method: 'POST',
            data: formdata,
            dataType    : 'json',
            encode          : true,
            success: function (response) {
                    console.log(response);
                    },
            error: function(xhr, textStatus, thrownError) {
                        alert(thrownError);
                    }
        });
}
function makereplyLike(replyid){
    let replyId = replyid ;
    //console.log(commId);
    let idtext = "Capa_r"+replyId;
    console.log(idtext);
    let replylikeIcon = document.getElementById(idtext);
    console.log(replylikeIcon);
    let tagname = ".LikeNum_r"+replyId;
    console.log(tagname);
    let res = "" ;
    if($(replylikeIcon).hasClass('replyLike-native'))
    {
        storeReplyLike(replyId);
        res  =$(tagname).text() ;
        console.log(res);
        res =  parseInt(res)+1 ;
        console.log("res"+res);
    }
    else
    {
        removeReplyLike(replyId);
        res  =$(tagname).text() ;
        console.log(res);
        res =  parseInt(res)-1 ;
        console.log("res"+res);
    }
    $(replylikeIcon).toggleClass("replyLike-native replylike-active" );
    $(tagname).html(res)  ;
}
function storeReplyLike(replyId){
    let id = replyId ;
    var formdata = {
            "id"     : id
        };

        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            url: "/replieslike",
            method: 'POST',
            data: formdata,
            dataType    : 'json',
            encode          : true,
            success: function (response) {
                    console.log(response);
                    },
            error: function(xhr, textStatus, thrownError) {
                        alert(thrownError);
                    }
        });

}
function removeReplyLike(replyId){

    let id =replyId;
    var formdata = {
            "id"     : id
        };

        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            url: "/repliesremovelike",
            method: 'POST',
            data: formdata,
            dataType    : 'json',
            encode          : true,
            success: function (response) {
                    console.log(response);
                    },
            error: function(xhr, textStatus, thrownError) {
                        alert(thrownError);
                    }
        });
}
// Comment Section
function addComment(postid , learnerid) {
    let post_id = postid;
    //console.log(post_id);
    let body = document.getElementById('commentBody').value;
    //console.log(body);
    if (body != "") {
        var formdata = {
            "body": body,
            "id": post_id
        };
      //  console.log(formdata);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            url: "/comments",
            method: 'POST',
            data: formdata,
            dataType: 'json',
            encode: true,
            success: function (response) {
               // console.log(response['comment']);
                let data = response['comment'];
                var date = new Date(data.created_at);
                var month = getMon(date.getMonth());
                var day = date.getUTCDate();
                var year = date.getFullYear();
                var heart_icon = assetpath + "svg/heart.svg";
                var chaticon = assetpath + "images/icons/chat.png";
                let replyicon = assetpath + "svg/Replyadd.svg";
                let moreicon = assetpath + "svg/more.svg";
                let comments_div = $('.comments');
                let comment = `<div class= "wholeComment">
                            <div class="comment-container">
                                        <div class= "comment">
                                            <div class="left">
                                                    <div class="Post_userdata">
                                                            <a  href="http://127.0.0.1:8000/profile/${username}"> <img  class="userPhoto" src="${avatar}" /></a>

                                                            <a  class="username"  href="http://127.0.0.1:8000/profile/${username}">${username}</a>
                                                            <p class="usertype">EDU Specialist</p>
                                                    </div>
                                            </div>
                                            <div class="right">
                                                    <div class="commentContent">
                                                    <div>
                                                        <span class="comment-body"
                                                        id="comment-body_${data.id}" > ${data.body}</span>
                                                        <div class ="comment_form" id = "comment_form_${data.id}" >
                                                            <form>
                                                                <div class="form-group">
                                                                    <input id="input_${data.id}"  class="commect-input-form form-control"
                                                                    type = "text"
                                                                    style = "width:90%"
                                                                    value = "${data.body}" / >
                                                                </div>
                                                                <button class= "comment_input_btn" onclick="update_comm(${data.id} )">Edit</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="dropleft">

                                                        <img class = "barIcon" src="${moreicon}" class = "dropdown-toggle" data-toggle ="dropdown" aria-haspopup="true" aria-expanded = "false" />

                                                        <div class="dropdown-menu">
                                                            <!-- Dropdown menu links -->
                                                                <a class = "dropdown-item" href = "#" id = "${data.id}" onclick = "toggle_update(${data.id})"> Edit </a>
                                                                <a class = "dropdown-item" href = "#" id = "${data.id}"nonclick = " delete_comm(this)" > Delete </a>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="comment-operations">
                                                    <p Class="comment_date">${day + " " + month + " " + year}</p>
                                                    <div class="leftside_comment">
                                                    <div class="commentcolSeperator"></div>
                                                    <svg class="native_like" onclick="makeCommentLike(${data.id})"   id="Capa_C${data.id}" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
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
                                                    <p class="numofloves" id= "numofloves_${data.id}">0</p>
                                                    <div class="commentcolSeperator"></div>
                                                    <img class = "postcomments-icon" src = "${chaticon}" data-toggle="collapse" data-target="#collapseExample${data.id}" aria-expanded="false" aria-controls="collapseExample${data.id}"/>
                                                    <p class="numofcomments" id ="repliesnum_${data.id}">0</p>
                                        </div>
                                    </div>
                                    <div  class="collapse replies" id="collapseExample${data.id}">
                                    <div class= "repliesnum">
                                        <div class="repliesname">Replies</div>
                                        <div class="square"></div>
                                        <div class="numofreplies">
                                        <p class="param"> ( </p>
                                        <p id="repliesnumm_${data.id}"> 0 </p>
                                        <p class="param"> ) </p>
                                    </div>
                                    </div>
                                    <div class="replies_data_${data.id}">
                                    </div>
                                    <div>
                                        <form class="addReplyDiv">
                                            <div class="AddReplydiv form-group">
                                                <textarea class="AddReply form-control " id = "Reply_${data.id}" name = "body"   rows="3" placeholder="Add your reply here.." ></textarea>
                                            </div>
                                            <div class="replybtndiv form-group" >
                                            <img class = "AddReplyBtn" src = "${replyicon}"  onclick="addreply(${data.id})" />
                                            </div>
                                        </form>
                                    </div>
                            </div>
                            </div>`;
                comments_div.append(comment);
                $('.add_comment').val("");

            },
            error: function (xhr, textStatus, thrownError) {
                alert(thrownError);
            }
        });

    }
}
function  delete_comm(comment){
        let comm_id = comment.id;
        var formdata = {
            "id"     : comm_id
        };

        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            url: "/comments",
            method: 'DELETE',
            data: formdata,
            dataType    : 'json',
            encode          : true,
            success: function (response) {
                    console.log(response);
                    },
            error: function(xhr, textStatus, thrownError) {
                        alert(thrownError);
                    }
        });

    comment.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.remove();

}
function  update_comm(commentid){
    let comm_id = commentid;
    let get_Commet_body_id = "input_" + comm_id;
    console.log(get_Commet_body_id);
    let val = document.getElementById(get_Commet_body_id).value;
    console.log(val);
    var formdata = {
            "body"     : val ,
            "id"       : comm_id
        };
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            url: "/commentsupdate",
            method: 'POST',
            data: formdata,
            dataType    : 'json',
            encode          : true,
            success: function (response) {
                    console.log(response);
                document.getElementById("comment-body_" + commentid).innerHTML = val;
                document.getElementById("comment-body_" + commentid).setAttribute("style", "display:block");
                document.getElementById("comment_form_" + commentid).setAttribute("style", "display:none");
            },
            error: function(xhr, textStatus, thrownError) {
                        alert(thrownError);
                    }
        });


}
function  addreply (commentId){
    var commentId = commentId ;
    let reply_body_tagid = "Reply_"+commentId ;
    console.log(reply_body_tagid);
    let body = document.getElementById(reply_body_tagid).value;
    //ajax request
    if(body != ""){
        var formdata = {
            "body"     : body ,
            "id"     : commentId
        };
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            url: "/replys",
            method: 'POST',
            data: formdata,
            dataType    : 'json',
            encode          : true,
            success: function (response) {
                console.log(response);
                let data =response['reply'] ;
                var date = new Date(data.created_at);
                var month = getMon(date.getMonth());
                var day = date.getUTCDate();
                var year = date.getFullYear();
                let replys_div_name = ".replies_data_"+commentId ;
                let replys_div = $(replys_div_name) ;
                console.log(replys_div);
                let reply = `<div class= "reply" >
                <div class="reply_userdata">
                    <a  href="http://127.0.0.1:8000/profile"><img  class="reply_userPhoto" src="${avatar}" /></a>
                    <a href="http://127.0.0.1:8000/profile" class="reply_username">${username}</a>
                    <p class="reply_usertype">Teacher</p>
                </div>
                <div class="replybody" >
                    ${body}
                    <hr class="lineseperator" />
                    <div class= "reply_operations">
                        <div class= "reply_opLeft">
                            <svg class="replyLike-native" onclick ="makereplyLike(${data.id})" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_r${data.id}" x="0px" y="0px" width="512px" height="512px" viewBox="0 0 456.814 456.814" style="enable-background:new 0 0 456.814 456.814;" xml:space="preserve">
                                <g>
                                    <g>
                                        <path d="M441.11,252.677c10.468-11.99,15.704-26.169,15.704-42.54c0-14.846-5.432-27.692-16.259-38.547    c-10.849-10.854-23.695-16.278-38.541-16.278h-79.082c0.76-2.664,1.522-4.948,2.282-6.851c0.753-1.903,1.811-3.999,3.138-6.283    c1.328-2.285,2.283-3.999,2.852-5.139c3.425-6.468,6.047-11.801,7.857-15.985c1.807-4.192,3.606-9.9,5.42-17.133    c1.811-7.229,2.711-14.465,2.711-21.698c0-4.566-0.055-8.281-0.145-11.134c-0.089-2.855-0.574-7.139-1.423-12.85    c-0.862-5.708-2.006-10.467-3.43-14.272c-1.43-3.806-3.716-8.092-6.851-12.847c-3.142-4.764-6.947-8.613-11.424-11.565    c-4.476-2.95-10.184-5.424-17.131-7.421c-6.954-1.999-14.801-2.998-23.562-2.998c-4.948,0-9.227,1.809-12.847,5.426    c-3.806,3.806-7.047,8.564-9.709,14.272c-2.666,5.711-4.523,10.66-5.571,14.849c-1.047,4.187-2.238,9.994-3.565,17.415    c-1.719,7.998-2.998,13.752-3.86,17.273c-0.855,3.521-2.525,8.136-4.997,13.845c-2.477,5.713-5.424,10.278-8.851,13.706    c-6.28,6.28-15.891,17.701-28.837,34.259c-9.329,12.18-18.94,23.695-28.837,34.545c-9.899,10.852-17.131,16.466-21.698,16.847    c-4.755,0.38-8.848,2.331-12.275,5.854c-3.427,3.521-5.14,7.662-5.14,12.419v183.01c0,4.949,1.807,9.182,5.424,12.703    c3.615,3.525,7.898,5.38,12.847,5.571c6.661,0.191,21.698,4.374,45.111,12.566c14.654,4.941,26.12,8.706,34.4,11.272    c8.278,2.566,19.849,5.328,34.684,8.282c14.849,2.949,28.551,4.428,41.11,4.428h4.855h21.7h10.276    c25.321-0.38,44.061-7.806,56.247-22.268c11.036-13.135,15.697-30.361,13.99-51.679c7.422-7.042,12.565-15.984,15.416-26.836    c3.231-11.604,3.231-22.74,0-33.397c8.754-11.611,12.847-24.649,12.272-39.115C445.395,268.286,443.971,261.055,441.11,252.677z" />
                                        <path d="M100.5,191.864H18.276c-4.952,0-9.235,1.809-12.851,5.426C1.809,200.905,0,205.188,0,210.137v182.732    c0,4.942,1.809,9.227,5.426,12.847c3.619,3.611,7.902,5.421,12.851,5.421H100.5c4.948,0,9.229-1.81,12.847-5.421    c3.616-3.62,5.424-7.904,5.424-12.847V210.137c0-4.949-1.809-9.231-5.424-12.847C109.73,193.672,105.449,191.864,100.5,191.864z     M67.665,369.308c-3.616,3.521-7.898,5.281-12.847,5.281c-5.14,0-9.471-1.76-12.99-5.281c-3.521-3.521-5.281-7.85-5.281-12.99    c0-4.948,1.759-9.232,5.281-12.847c3.52-3.617,7.85-5.428,12.99-5.428c4.949,0,9.231,1.811,12.847,5.428    c3.617,3.614,5.426,7.898,5.426,12.847C73.091,361.458,71.286,365.786,67.665,369.308z"  />
                                    </g>
                                </g>

                            </svg>
                            <p class = "LikeNum_r${data.id}">0</p>
                        </div>
                        <div class= "reply_opright">
                            <div class="reply_col_sep"></div>
                            <p Class="replydate">${day + " " + month + " " +year}</p>

                        </div>
                    </div>
                    <hr class="lineseperator" />
                </div>

            </div>`;
                replys_div.append(reply);
                // update num of replies in comment card
                let tagname = "#repliesnum_"+commentId;
                let res  =$(tagname).text() ;
                res =  parseInt(res)+1 ;
                $(tagname).html(res)  ;
                //update num of replies in replies card header
                let tagname2 = "#repliesnumm_"+commentId;
                let res2  =$(tagname2).text() ;
                res2 =  parseInt(res2)+1 ;
                $(tagname2).html(res2);
                $('.AddReply').val("");
            },
            error: function(xhr, textStatus, thrownError) {
                        alert(thrownError);
                    }
        });
    }


}
function delete_reply(reply){
    let reply_id = reply.id;
        var formdata = {
            "id"     : reply_id
        };

        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            url: "{{ url('/replys/delete') }}",
            method: 'POST',
            data: formdata,
            dataType    : 'json',
            encode          : true,
            success: function (response) {
                    console.log(response);
                    },
            error: function(xhr, textStatus, thrownError) {
                        alert(thrownError);
                    }
        });

        reply.parentElement.parentElement.remove();
}
function update_Reply(reply ){
    let reply_id = reply.id;
    let get_reply_body_id = "value_"+reply_id ;
    console.log(get_reply_body_id);
    let val = document.getElementById(get_reply_body_id).textContent;
    console.log(val);
    var formdata = {
            "body"     : val ,
            "id"       : reply_id
        };
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            url: "{{ url('/replys/update') }}",
            method: 'POST',
            data: formdata,
            dataType    : 'json',
            encode          : true,
            success: function (response) {
                    console.log(response);
                    document.getElementById(get_reply_body_id).innerHTML = val ;
            },
            error: function(xhr, textStatus, thrownError) {
                        alert(thrownError);
                    }
        });

}
function  intialize(){
    let idAtrr = '#Cat_'+cat1;
    let conAtrr = '#topicContainer_'+cat1;
    $(idAtrr).toggleClass("topicTitle topic-Active" );
    $(conAtrr).toggleClass("topicContainer topicContainer-active");
    beforeid = idAtrr ;
    beforeContainer = conAtrr ;
}
function getIndexToPost(postid){
    window.location = `/posts/${postid}`;
}
function toggle_update(comm_id) {
    document.getElementById("comment-body_"+comm_id).setAttribute("style", "display:none");
    document.getElementById("comment_form_"+comm_id).setAttribute("style", "display:block");
}
function delete_post(postId) {
    let id = postId;
    var formdata = {
        "id": id
    };
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
        url: "/posts",
        method: 'DELETE',
        data: formdata,
        dataType: 'json',
        encode: true,
        success: function (response) {
            console.log(response);
            window.location.href = "/posts";
        },
        error: function (xhr, textStatus, thrownError) {
            alert(thrownError);
        }
    });

}
function toggle_update_post(postid) {
    window.location.replace(`/posts/edit/${postid}`) ;
}

   function marknotificationEvents(notificationId) {
       console.log(notificationId);
       var formdata = {
           "id": notificationId,
       };

       $.ajax({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
           },
           url: "/notificationread",
           method: 'POST',
           data: formdata,
           dataType: 'json',
           encode: true,
           success: function (response) {
               console.log(response);
           },
           error: function (xhr, textStatus, thrownError) {
               alert(thrownError);
           }
       });
   }

intialize();
