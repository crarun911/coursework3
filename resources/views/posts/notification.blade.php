@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                    @csrf
                       @foreach(auth()->user()->notifications as $notification)
                       <div class="bg-blue-300 p3 m-2">
                        {{$notification->data['name']}} started following you
                       </div>
                        @endforeach
                       
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection