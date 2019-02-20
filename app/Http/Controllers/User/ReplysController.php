<?php


namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\TextEditor;
use DB;
use App\Post ;
use App\Comment ;
use App\Reply ;
use App\Learner;
use App\Notifications\LikeToReply;
use App\Notifications\ReplyToComment;
use App\Events\LikedToReplyNotification;
use App\Events\RepliedToCommentNotification;


class ReplysController extends Controller
{
    function store(Request $request){
        $validator = validator::make($request->all(), [
           'body' => 'required',
           'id' => 'required'
        ]);
        $userid = auth()->guard('learner')->user()->id ;
        $reply = new Reply();
        $reply->body = $request->body ;
        $reply->comment_id = $request->id ;
        $reply->learner_id = $userid ;
        $reply->save();
        $comment = Comment::find($request->id);
        $post = Post::find($comment->commentable_id);
        $notifiedUser = Learner::find($comment->learner_id);
        if ($notifiedUser->id <> auth()->guard('learner')->user()->id) {
           $notifiedUser->notify(new ReplyToComment($reply, $post->id , $notifiedUser));
           //event(new RepliedToCommentNotification($notifiedUser ,$reply , $post->id ));
        }


       return response()->json(['reply' => $reply]);
   }
   function  delete(Request $request){
        $validator = validator::make($request->all(), [
            'id' => 'required'
        ]);
        $reply = Reply::where('id'  , $request->id)->delete();
        return response()->json(['status' => 'deleted']);
   }
   function update (Request $request){
        $validator = validator::make($request->all(), [
            'id' => 'required' ,
            'body' => 'required'
        ]);
        Reply::where('id', $request->id)->update(['body' => $request->body]);
        return response()->json(['status' => 'updated']);
   }
    function  markLike(Request $request){
        $validator = validator::make($request->all(), [
            'id' => 'required'
        ]);
        $user = auth()->guard('learner')->user();
        $reply = Reply::find($request->id);
        $user->like($reply);
        $comment = Comment::find($reply->comment_id);
        $post = Post::find($comment->commentable_id);
        $notifiedUser = Learner::find($reply->learner_id);
        if ($notifiedUser->id <> auth()->guard('learner')->user()->id) {
            $notifiedUser->notify(new LikeToReply($reply , $post->id , $notifiedUser));
           // event( new LikedToReplyNotification($notifiedUser , $reply , $post->id ));
        }
        return response()->json(['status' => 'Liked']);
    }
    function removeLike(Request $request){
        $validator = validator::make($request->all(), [
            'id' => 'required'
        ]);
        $user = auth()->guard('learner')->user();
        $reply = Reply::find($request->id);
        $user->unlike($reply);
        return response()->json(['status' => 'removed']);
    }
}
