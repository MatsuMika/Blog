@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          <h1>詳細ページ</h1>
          <a href="{{ route('posts.create') }}" class="btn btn-primary">新規投稿</a>
          <div class="card text-center">
            <div class="card-header">
              Blogs
            </div>
              <div class="card-body">
                <h5 class="card-title">タイトル：{{ $post->title }}</h5>
                <p class="card-text">内容：{{ $post->body }}</p>
                <p class="card-text">投稿者：{{ $post->user->name }}</p>
                @if( Auth::id() === $post->user_id )
                    <a href=" {{ route('posts.edit',$post->id) }}" class="btn btn-primary">編集</a>                
                    <form action="{{ route('posts.destroy', $post->id) }}" method='post'>
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <input type='submit' value='削除' class="btn btn-danger" onclick='return confirm("削除しますか？？");'>
                    </form>
                @endif
              </div>
              <div class="card-footer text-muted">
                投稿日時：{{ $post->created_at }}
              </div>
          </div>
        </div>
    </div>
</div>
@endsection