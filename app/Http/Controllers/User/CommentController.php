<?php

namespace App\Http\Controllers\User;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentStoreRequest;
use App\Learner;
use App\Notifications\commentedToPost;
use App\Notifications\LikeToComment;
use App\Post;
use App\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{

    public function update(CommentStoreRequest $request, Comment $comment)
    {
        $comment->update($request->only('body'));

        return api(['success' => true]);
    }

    public function destroy(Comment $comment)
    {
        return api(['success' => $comment->delete()]);
    }

    public function toggleLike(Comment $comment)
    {

        auth()->user()->toggleLike($comment);

        $likes_count = $comment->likes_count;

        $success = true;

        $liked = $comment->liked;

        return api(compact('liked', 'likes_count', 'comment'));
    }

    public function replies(Comment $comment)
    {

        $replies = $comment->replies()->with('learner:name,avatar,id,username')->withCount('likes')->get(5);

        return api(compact('replies', 'comment'));
    }

    public function addReply(CommentStoreRequest $request, Comment $comment)
    {
        $reply = $comment->replies()->create([
            'body' => $request->body,
            'learner_id' => auth()->id(),
        ]);

        $reply->load('learner');

        return api(compact('reply'));
    }

    /** Sherif Work */
    public function store(Request $request)
    {
        $user = Auth::guard('learner')->user();
        $userid = $user->id;
        $validator = validator::make($request->all(), [
           'body' => 'required',
           'id' => 'required'
       ]);
       $post = Post::find($request->id);
       $comm = $post->comments()->create(['body' => $request->body , 'learner_id' => $userid ]);
      /* $notifiedUser = Learner::find($post->learner_id);
       if($notifiedUser->id <> auth()->guard('learner')->user()->id){
            $notifiedUser->notify(new CommentedToPost($comm , $notifiedUser));
            //event( new CommentedToPostNotification($notifiedUser , $comm));
       }*/
       return response()->json(['comment' => $comm]);
    }

    public function markLike(Request $request)
    {
        $validator = validator::make($request->all(), [
            'id' => 'required',
        ]);
        $user = auth()->guard('learner')->user();
        $comment = Comment::find($request->id);
        $user->like($comment);
        /*$notifiedUser = Learner::find($comment->learner_id);
        if ($notifiedUser->id <> auth()->guard('learner')->user()->id){
            $notifiedUser->notify(new LikeToComment($comment , $notifiedUser));
            //event(new LikedToCommentNotification($notifiedUser , $comment));
        }*/
        return response()->json(['status' => 'Liked']);
    }
    public function removeLike(Request $request)
    {
        $validator = validator::make($request->all(), [
            'id' => 'required',
        ]);
        $user = auth()->guard('learner')->user();
        $comment = Comment::find($request->id);
        $user->unlike($comment);
        return response()->json(['status' => 'removed']);
    }

    public function delete(Request $request)
    {
        $validator = validator::make($request->all(), [
            'id' => 'required',
        ]);
        $replies = Reply::where('comment_id', $request->id)->delete();
        $comment = Comment::where('id', $request->id)->delete();
        return response()->json(['status' => 'deleted']);
    }
    public function update_comm(Request $request)
    {
        $validator = validator::make($request->all(), [
            'id' => 'required',
            'body' => 'required',
        ]);
        Comment::where('id', $request->id)->update(['body' => $request->body]);
        return response()->json(['status' => 'updated']);
    }

    /**  */
}
