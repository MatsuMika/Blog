<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Auth;
use App\Post;

class PostController extends Controller
{
    public function index(){

        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    public function create(){
        return view('posts.create');
    }

    public function show($id){

        $post = Post::find($id);

        return view('posts.show', compact('post'));
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

    public function update(PostRequest $request, $id) {
        //dd($$request);　確認用
        //dd(Auth::user());　確認用

        $post = Post::find($id);

        if( Auth::id() !== $post->user_id ){
            return abort(404);
        }

        $post->title      = $request->title;
        $post->body       = $request->body;

        $post->save();

        return redirect()->route('posts.index');
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

