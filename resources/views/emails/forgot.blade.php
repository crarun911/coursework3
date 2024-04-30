@component('mail::message')
<p>Hello {{$user->name}}</p>
@component('mail::button',['url'=>url('reset/'.$user->remember_token)])
Reset your password
Thanks <br/>
{{config('app.name')}}
@endcomponent