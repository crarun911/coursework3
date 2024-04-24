@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Feed</div>

                <div class="card-body">
                    @foreach ($posts as $post)
                        <div class="post">
                            <div class="post-header">
                                <strong>{{ $post->user->name }}</strong> posted on {{ $post->created_at->format('F j, Y \a\t g:i A') }}
                            </div>
                            <div class="post-content">
                                {{ $post->content }}
                            </div>
                            <div class="post-footer">
                                <button class="btn btn-sm btn-primary">Like ({{ $post->likes }})</button>
                                <span class="post-views">Views: {{ $post->views }}</span>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
