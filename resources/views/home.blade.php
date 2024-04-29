@extends('layouts.app')

@section('content')
    @include('includes.message-block')
    <section class="row new-post">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>What's on your mind?</h3></header>
            <form  method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                <div class="form-group">
                    <textarea class="form-control" name="body" id="new-post" rows="5" placeholder="Your Post"></textarea>
                </div>
                <div class="form-group">
                    <input type="file" class="form-control-file" id="image" name="image">
                </div>
                <button type="submit" class="btn btn-primary">Create Post</button>
                @csrf
            </form>
        </div>
    </section>

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
                        <a href="#" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like'  }}</a> |
                        @if(Auth::user()==$post->user)
                            <a href="#" class="edit">Edit</a> |
                            <a href="{{route('post.delete',['post_id'=>$post->id])}}" class="delete">Delete</a> 
                        @endif
                    </div>
                    <div class="comment-section">
                        <ul class="comments">
                            @foreach($post->comments as $comment)
                                <li>{{ $comment->body }}</li>
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
            {{$posts->links('pagination::bootstrap-4')}}
       </div>  
    </section>
    @endif

    <div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Post</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="post-body">Edit the Post</label>
                            <textarea class="form-control" name="post-body" id="post-body" rows="5"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="modal-save">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        var token = '{{ Session::token() }}';
        var urlEdit = '{{ route('edit') }}';
        var urlLike = '{{ route('like') }}';

    </script>        
@endsection