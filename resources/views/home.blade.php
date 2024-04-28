@extends('layouts.app')

@section('content')
    @include('includes.message-block')
    <section class="row new-post">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>What do you have to say?</h3></header>
            <form  method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                <div class="form-group">
                    <textarea class="form-control" name="body" id="new-post" rows="5" placeholder="Your Post"></textarea>
                </div>
                <div class="form-group">

                <input type="file" class="form-control-file" id="image" name="image">
                </div>
                <button type="sbmit" class="btn btn-primary">Create Post</button>
                <input type="hidden" value="{{ csrf_token() }}" name="_token">
            </form>
        </div>
    </section>
    <section class="row posts">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>What other people say...</h3></header>
            @foreach($posts as $post)
            <article class="post" data-postid="">
                    <p>{{$post->content}}</p>
                    <div class="info">
                        posted by {{$post->user->name}} on {{$post->created_at}}
                    </div>
                    <div class="interaction">
                        <a href="#" class="like">Like</a> |
                        <a href="#" class="dislike">Dislike</a> |
                        @if(Auth::user()==$post->user)
                        <a href="#" class="edit">Edit</a> |
                        <a href="{{route('post.delete',['post_id'=>$post->id])}}" class="delete">Delete</a> 
                        @endif
                    </div>
                </article>
            @endforeach
       </section>  
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
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
        </div>
@endsection