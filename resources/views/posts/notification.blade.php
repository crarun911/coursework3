@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Notifications</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                    @csrf
                    @foreach(auth()->user()->unreadnotifications as $notification)
    <div class="bg-blue-300 p3 m-2">
        
        @if(isset($notification->data['name']))
            {{ $notification->data['name'] }} has sent a a friend request
            <a href="{{route('markasread',$notification->id)}}">Accept</a>
        @else
            Notification data is missing 'name' key
        @endif
    </div>
@endforeach
                       
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection