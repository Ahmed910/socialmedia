<?php

namespace App\Http\Controllers;

use App\Comment;
use App\HelperAPI;
use App\Like;
use App\Notifications\NotifyUsers;
use App\Post;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Notification;

class PostController extends Controller
{
    public function getIndex(Request $request){

     $posts=Post::orderBy('created_at','desc')->paginate(2);
    //  dd($posts);
      return view('blog.index',['posts'=>$posts]);
    }
    public function getAdminIndex(){

        $posts=Post::all();
       return view('admin.index',['posts'=>$posts]);
    }
    public function getPost($id){
        $post=Post::find($id);
        $comments=Comment::select('comments.body','users.name')->where('comments.post_id',$post->id)->join('users','users.id','comments.user_id')->get();
        // dd($comments);
        return view('blog.post',['post'=>$post,'comments'=>$comments]);
    }

    public function about(){

        return view('other.about');
    }
    public function getLikePost($id){
        $post=Post::find($id);
        $like=new Like();
        $post->likes()->save($like);
        return redirect()->back();
    }
    public function getAdminCreate(){
        // if(!Auth::check()){
        //     return redirect()->back();
        //  }
        $tags=Tag::all();
        return view('admin.create',['tags'=>$tags]);
    }
    public function getAdminEdit($id)
    {
        // if(!Auth::check()){
        //     return redirect()->back();
        //  }
        $post=Post::find($id);
        $tags=Tag::all();
        return view('admin.edit',['post'=>$post,'postId'=>$id,'tags'=>$tags]);
    }
    public function postAdminCreate(Request $request)
    {
        if($request->ajax()){
            $this->validate($request,
            [
                'title'=>'required|min:5',
                'content'=>'required|min:10'
            ]);
            $user=Auth::user();
            if(!$user){
                return redirect()->back();
            }
            $post=new Post([
                'title'=>$request->input('title'),
                'content'=>$request->input('content')
            ]);
            $users=User::where('id','!=',$user->id)->get();

            $user->posts()->save($post);
            $post->tags()->attach($request->input('tags')===null?[]:$request->input('tags'));

        }
        Notification::send($users, new NotifyUsers($user));

        return redirect()->route('admin.index')
        ->with('info','post created , Title is : '. $request->input('title'));


    }
    public function postAdminUpdate(Request $request)
    {
        // if(!Auth::check()){
        //    return redirect()->back();
        // }
        $this->validate($request,
        [
            'title'=>'required|min:5',
            'content'=>'required|min:10'
        ]);
        $post=Post::find($request->input('id'));
        if(Gate::denies('manipulate-post',$post)){
            return redirect()->back();
        }
        $post->title=$request->input('title');
        $post->content=$request->input('content');
        $post->save();
      //  $post->tags()->detach();
      //  $post->tags()->attach($request->input('tags')===null?[]:$request->input('tags'));
      // = $post->tags()->sync($request->input('tags')===null?[]:$request->input('tags'));
        $post->tags()->sync($request->input('tags')===null?[]:$request->input('tags'));
        return redirect()->route('admin.index')
        ->with('info','post Edited , New Title is : '. $request->input('title'));
    }
    public function getAdminDelete($id){
        // if(!Auth::check()){
        //     return redirect()->back();
        //  }
       $post=Post::find($id);
       if(Gate::denies('manipulate-post',$post)){
        return redirect()->back();
    }
       $post->likes()->delete();
       $post->tags()->detach();
       $post->delete();
       return redirect()->route('admin.index')
       ->with('info','Post Deleted');
    }
  /*  public function postAdminCreate(Request $request){
        $this->validate($request,
        ['title'=>'required|min:5',
        'content'=>'required|min:5']);
        $post=new Post([
           'title'=>$request->input('title'),
           'content'=>$request->input('content')
        ]);
        $post->save();
    }  */
}
