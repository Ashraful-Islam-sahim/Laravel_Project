@extends('layouts.admin-template')

@section('content')
        
    <form method="POST" action="{{route('login')}}">
        @csrf
        <div class="form-group">
            <input type="text" name="email" id="email" value="{{old('email')}}" class="form-control" placeholder="Enter your email">
          </div><!-- form-group -->
          <div class="form-group">
            <input type="password" name="password" id="password" value="{{old('password')}}" class="form-control" placeholder="Enter your password">
            @if (Route::has('password.request'))
                <div class="mg-t-20 text-center">Forget you password? <a href="{{route('password.request')}}" class="text-info">Click Here</a></div>
            @endif
          </div><!-- form-group -->
          <button type="submit" class="btn btn-info btn-block">Sign In</button>

           
          <div class="mg-t-60 tx-center">Not yet a member? <a href="{{route('register')}}" class="tx-info">Sign Up</a></div>
    </form>

@endsection