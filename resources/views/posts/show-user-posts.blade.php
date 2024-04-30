<!-- user/posts.blade.php -->

@extends('layouts.app')

@section('content')
    <section class="row">
        <div class="col-md-6 col-md-offset-3">
            <header>
                <h3>Posts by {{$user->name}}</h3>
                <a href="{{route('notify',Auth::user()->id)}}">Follow</a>
                
            </header>
            @if($posts)
    <section class="row posts">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>Recent Posts...</h3></header>
            @foreach($posts as $post)
                <article class="post" data-postid="{{$post->id}}">
                    <p><h5>{{$post->body}}</h5></p>
                    @if($post->image)
                        <img src="{{ asset('images/'.$post->image) }}" class="img-responsive" alt="Post Image">
                    @endif
                    <div class="info">
                        posted by <a href="{{ route('user.posts', ['user' => $post->user]) }}">{{$post->user->name}}</a> on {{$post->created_at}}
                    </div>
                    <div class="interaction">
                        <a href="#" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like'  }}</a> 
                        @if(Auth::check() && Auth::user()->id == $post->user->id)
                            |<a href="#" class="edit">Edit</a> |
                            <a href="{{route('post.delete',['post_id'=>$post->id])}}" class="delete">Delete</a> 
                        @endif
                    </div>
                    <div class="comment-section">
                        <ul class="comments">
                            @foreach($post->comments as $comment)
                                @if($comment->content!=null)
                                <li>{{ $comment->content}}</li>
                                @endif
                            @endforeach
                        </ul>
                        <form class="comment-form" action="{{ route('comment.store', ['post' => $post]) }}" method="post">
                            <input type="text" name="body" placeholder="Add a comment">
                            <button type="submit">Comment</button>
                            @csrf
                        </form>
                    </div>
                </article>
                <hr>
            @endforeach
       </div>  
    </section>
    @endif
        </div>
    </section>
    <script>
        var token = '{{ Session::token() }}';
        var urlEdit = '{{ route('edit') }}';
        var urlLike = '{{ route('like') }}';

    </script>
@endsection
