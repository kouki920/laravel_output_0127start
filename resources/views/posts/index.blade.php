
@extends('layouts.app')

@section('content')



<div class="container mt-4">

<div class="mb-4">
<a href="{{route('board.create')}}" class="btn btn-primary">投稿</a>
</div>

@foreach($posts as $post)

<div class="card mb-4">
                <div class="card-header">
                    {{ $post->title }}
                </div>
                <div class="card-body">
                <p class="card-text">
                        {!! nl2br(e(Str::limit($post->body, 140))) !!}
                        <!-- 文字数表示制限 -->
                    </p>
</div>
<div class="card-footer">
                    <span class="mr-2">
                    投稿日時 {{ $post->created_at }}
                    </span>
                    @if ($post->comments->count())
                        <span class="badge badge-primary">
                            コメント {{ $post->comments->count() }}件
                        </span>
                    @endif
</div>
</div>
@endforeach
</div>
@endsection
