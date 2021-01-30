
@extends('layouts.app')

@section('content')



<div class="container mt-4">


<div class="card mb-4">
                <div class="card-header">
                    タイトル: {{ $post->title }}
                </div>
                <div class="card-body">
                <p class="card-text">
                        {!! nl2br(e(Str::limit($post->body, 140))) !!}
                        <!-- 文字数表示制限 -->
                    </p>
</div>
<div class="card-footer">
                    <span class="mr-2">
                    投稿日時 {{ $post->created_at->format('Y.m.d H:i') }}
                    </span>
                    <section>
                    <form class="mb-4" method="POST" action="{{ route('comment.store') }}">
    @csrf

    <input
        name="post_id"
        type="hidden"
        value="{{ $post->id }}"
    >

    <div class="form-group">
        <label for="body">
            本文
        </label>

        <textarea
            id="body"
            name="body"
            class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}"
            rows="4"
        >{{ old('body') }}</textarea>
        @if ($errors->has('body'))
            <div class="invalid-feedback">
                {{ $errors->first('body') }}
            </div>
        @endif
    </div>

    <div class="mt-4">
        <button type="submit" class="btn btn-primary">
            コメントする
        </button>
    </div>
</form>

                <h2 class="h5 mt-2 mb-2">
                    コメント
                </h2>
                @forelse($post->comments as $comment)
                    <div class="border-top p-4">
                        <time class="text-secondary">
                            {{ $comment->created_at->format('Y.m.d H:i') }}
                        </time>
                        <p class="mt-2">
                            {!! nl2br(e($comment->body)) !!}
                        </p>
                    </div>
                @empty
                    <p>コメントはまだありません。</p>
                @endforelse
            </section>

</div>
</div>

</div>
@endsection