<!-- user/posts.blade.php -->

@extends('layouts.app')

@section('content')
    <section class="row">
        <div class="col-md-6 col-md-offset-3">
            <header>
                <h3>Posts by {{$user->name}}</h3>
            </header>
            @foreach($posts as $post)
                <article class="post" data-postid="{{$post->id}}">
                    <p>{{$post->body}}</p>
                    <div class="info">
                        posted on {{$post->created_at}}
                    </div>
                    <!-- Add interactions as needed -->
                </article>
            @endforeach
        </div>
    </section>
@endsection
