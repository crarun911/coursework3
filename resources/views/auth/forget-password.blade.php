@extends("layouts.app")
@section("content")
    <main>
        <div class="ms-auto me-auto mt-5">
        @include('includes.message-block')
         <form class="form-horizontal" role="form" method="POST" action="{{ route('forget.password.post') }}">
                    @csrf
                        
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>   </strong>
                                    </span>
                                @endif
                            </div>
                            <div>
                            <button type="submit" class="btn btn-primary">Submit</button>
</div>
                        </div>
                        
                    </form>
        </div>
</main>
@endsection