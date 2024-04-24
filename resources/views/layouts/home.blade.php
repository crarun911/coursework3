
@extends('layouts.app')

@section('content')
    <div class="container">
    <div class="container">
        <div class="row justify-content-center mt-3">
            <div class="col-md-8">
                <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Create New Post</a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Recent Posts</div>

                    <div class="card-body">
                        @foreach ($posts as $post)
                            <div class="post">
                                <div class="post-content">
                                    <p>{{ $post->content }}</p>
                                    @if ($post->image)
                                        <img src="{{ asset('images/' . $post->image) }}" alt="Post Image">
                                    @endif
                                </div>
                                <div class="post-footer">
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
