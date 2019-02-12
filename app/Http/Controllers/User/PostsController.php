<?php
namespace App\Http\Controllers\User;

use App\Classes\TextEditor;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\LikeToPost;
use DB;
use DomDocument;
use App\Category;
use App\Post ;
use App\Tag ;
use App\User ;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use App\Events\LikedToPostNotification;
class PostsController extends Controller
{
    function showNewPost(Request $request ){
        $categories = Category::all();
        return view('learner.posts.create' , compact('categories'));
    }
    function store(Request $request){

         $validator = validator::make($request->all(), [
            'Title' => 'required',
            'Body' => 'required',
            'Tag' => 'required',
            'Category' => 'required'
        ])->validate();
        $userid = auth()->user()->id ;
        //dd($userid);
        $post = new Post() ;
        $post->title  = $request->Title ;
        $post->body = TextEditor::create($request->Body, 'posts');
        $post->user_id = $userid;
        $post->category_id = $request->Category ;
        $post->views_number = 0 ;
        //****************** Get Short Body ****************/
            $dom = new DomDocument();
            $dom->loadHtml($request->Body, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $pharags = $dom->getElementsByTagName('p');
            $text="";
            $i = 0 ;
            foreach ($pharags  as $p){
                if ( strlen($text)+strlen($p->nodeValue)  <= 200 ){
                    $text .= "<p>".$p->nodeValue."</p>"."<br/>";
                }
                $i++;

            }
            $post->description = $text ;
            $post->save();
        //****************** Tags **************/
            $parts = explode(",", $request->Tag);
            $result =array() ;
            for ( $i = 0 ; $i < sizeof($parts) ; $i++){
                $tagg = trim($parts[$i]);
                $s_tag =  Tag::where('body', $tagg)->get();
                if($s_tag->isEmpty()){
                    $tag = new Tag();
                    $tag->body = $tagg ;
                    $tag->save();
                    $tagId = $tag->id ;
                }else {
                    $tagId = $s_tag[0]->id ;
                }
                //*********************/
                $postid = $post->id;
               $post_tags = DB::table('post_tag')->insert(['post_id' => $postid, 'tag_id' =>  $tagId]);

            }
        //******************** */
        return response()->json(['status' => 'added']);

    }

    function  index(){
        $categories = Category::all();
        $cat1_id = $categories[0]->id ;
        $posts = Post::where('category_id' ,$cat1_id)->get();
        $lastPosts = Post::orderBy('id' , 'desc')->limit(2)->get();
        $tags = DB::select('select tags.id , tags.body, count(tags.id) as count from tags join post_tag on tags.id = post_tag.tag_id GROUP BY tags.id,tags.body ORDER BY count DESC');
        return view('learner.posts.index' , compact('posts' , 'categories' , 'tags' , 'lastPosts'));
    }
    function indexToCat(Request $request , Category $category){
        $category->load('posts.tags' ,'posts.learner' , 'posts.comments');
        $posts = $category->posts ;
        return response()->json(['posts' => $posts]);
    }
    function  getTagPosts(Request $request , Tag $tag ){
        $tag->load('posts.tags' ,'posts.learner', 'posts.comments');
        $posts = $tag->posts ;
        return response()->json(['posts' => $posts]);
    }
    function indexToPost(Request $request , Post $post){
        $user_id =  $user = auth()->user()->id ;
        if($post->user->id!= $user_id){
            DB::table('posts')->whereId($post->id)->increment('viewsNumber');
        }

        $categories = Category::all();
        $lastPosts = Post::orderBy('id' , 'desc')->limit(2)->get();
        $tags = DB::select('select tags.id , tags.body, count(tags.id) as count from tags join post_tag on tags.id = post_tag.tag_id GROUP BY tags.id,tags.body ORDER BY count DESC');

     $comCount =$post->comments()->count();

        return view('learner.posts.post' , compact('post' , 'categories' ,'lastPosts','tags' , 'comCount' ));
    }
    function  markLike(Request $request){

        $validator = validator::make($request->all(), [
            'id' => 'required'
        ]);
        $user = auth()->user();
        $post = Post::find($request->id);
        $user->like($post);
        //*************notification*************/
        /*$notifiedUser = Learner::find($post->learner_id);
        if ($notifiedUser->id <> auth()->guard('learner')->user()->id) {
            $notifiedUser->notify(new LikeToPost($post , $notifiedUser));
            //event(new LikedToPostNotification($notifiedUser , $post));
        }*/
        return response()->json(['status' => 'Liked']);
    }
    function removeLike(Request $request){
        $validator = validator::make($request->all(), [
            'id' => 'required'
        ]);
        $user = auth()->user();
        $post = Post::find($request->id);
        $user->unlike($post);
        return response()->json(['status' => 'removed']);
    }
    function delete(Request $request){
        $validator = validator::make($request->all(), [
            'id' => 'required'
        ]);
        $post = Post::destroy($request->id);
        return api(['deleted' => true]);
    }
    function update(Request $request , Post $post ){
        $categories = Category::all();

        $tagsBody = "" ;
        foreach ($post->tags as $tag){
            $tagsBody .= $tag->body . " " ;
        }
        return view ('learner.posts.edit' , compact('post' , 'categories' , 'tagsBody'));
    }
    function edit(Request $request, Post $post){
        //dd($request->all());
        $validator = validator::make($request->all(), [
            'title' => 'required',
            'body' => 'required',
            'tag' => 'required',
            'cat' => 'required'
        ]);

        $ppost = Post::where('id', $post->id)
            ->update(['title' => $request->title , 'body' => TextEditor::create($request->body, 'posts'), 'category_id' => $request->cat , 'viewsNumber'=> 0]);
        //************************ */
        $parts = explode("#", $request->tag);
        $result = array();
        for ($i = 1; $i < sizeof($parts); $i++) {
            $tagg = "#" . trim($parts[$i]);
            $s_tag = Tag::where('body', $tagg)->get();
            if ($s_tag->isEmpty()) {
                $tag = new Tag();
                $tag->body = $tagg;
                $tag->save();
                $tagId = $tag->id;
            } else {
                $tagId = $s_tag[0]->id;
            }
               //*********************/
            $postid = $post->id ;
            $temp = DB::table('post_tag')->where('post_id' , $postid)->where('tag_id', $tagId)->get();
            if($temp->isEmpty()){
                $post_tags = DB::table('post_tag')->insert(['post_id' => $postid, 'tag_id' => $tagId]);
            }

        }
        //*** return to index */
        $categories = Category::all();
        $cat1_id = $categories[0]->id;
        $posts = Post::where('category_id', $cat1_id)->get();
        $lastPosts = Post::orderBy('id', 'desc')->limit(2)->get();
        $tags = DB::select('select tags.id , tags.body, count(tags.id) as count from tags join post_tag on tags.id = post_tag.tag_id GROUP BY tags.id,tags.body ORDER BY count DESC');
        return view('learner.posts.index', compact('posts', 'categories', 'tags', 'lastPosts'));
    }
    function MarkReadNotification(Request $request)
    {

        $validator = validator::make($request->all(), [
            'id' => 'required'
        ]);
        $date = Carbon::now()->toDateTimeString();
        $notification = DB::table('notifications')->where('id', $request->id)
            ->update(['read_at' => $date]);
        return response()->json(['notification' => $notification]);
    }
}
