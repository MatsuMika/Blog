<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Auth;
use App\Post;
use App\Comment;
use App\User;
use Carbon\Carbon;

class PostController extends Controller
{
    public function index(){

        $posts = Post::all();
        
        $datetime = Carbon::now()->format('Y-m');

        $post_month_count = Post::where('created_at', 'like', "%$datetime%")->count();

        $user_month_count = User::where('created_at', 'like', "%$datetime%")->count();

        return view('posts.index', compact('posts','post_month_count','user_month_count'));
    }

    public function create(){
        return view('posts.create');
    }

    public function show($id){

        $post = Post::find($id);

        $comments = Comment::where('post_id', $id)->get();

        return view('posts.show', compact('post', 'comments'));
    }

    public function store(PostRequest $request) {
        //dd($$request);　確認用
        //dd(Auth::user());　確認用

        $post = new Post;
        //インスタンス作成
        $post->title      = $request->title;
        $post->body       = $request->body;
        $post->user_id    = Auth::id();//ログイン中のユーザid　（Auth::user(）->id; の省略
        
        //インスタンスの保存
        $post->save();

        return redirect()->route('posts.index');
    }

    public function edit($id){

        $post = Post::find($id);

        if( Auth::id() !== $post->user_id ){
            return abort(404);
        }

        return view('posts.edit', compact('post'));
    }

    public function update(PostRequest $request, $id){

        $post = Post::find($id);

        if( Auth::id() !== $post->user_id ){
            return abort(404);
        }

        $post->title  = $request->title;
        $post->body   = $request->body;

        $post->save();
        return view('posts.show', compact('post'));
        //return redirect()->route('posts.index');
    }

    public function destroy($id){

        $post = Post::find($id);

        if( Auth::id() !== $post->user_id ){
            return abort(404);
        }

        $post->delete();

        return redirect()->route('posts.index');
    }

}

