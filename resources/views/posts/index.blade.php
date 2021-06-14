@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          <h1>一覧ページ</h1>
          <p>【今月】<br>
            投稿　　：{{ $post_month_count }} 件<br>
            登録者数：{{ $user_month_count }} 人
          </p>      
          <a href="{{ route('posts.create') }}" class="btn btn-primary">新規投稿</a>
          @foreach ($posts as $post)
              <div class="card text-center">
                <div class="card-header">
                    by {{ $post->user->name }}　　{{ $post->title }}
                </div>                
                  <div class="card-body">
                    <p class="card-text">{{ $post->body }}</p>
                    <a href=" {{ route('posts.show',$post->id) }}" class="btn btn-primary">詳細</a>
                  </div>
                  <div class="card-footer text-muted">
                    投稿日時：{{ $post->created_at }}
                  </div>           
              </div>
          @endforeach
        </div>
    </div>
</div>
@endsection