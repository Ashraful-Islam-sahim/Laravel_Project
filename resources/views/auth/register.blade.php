@extends('layouts.admin-template')

@section('content')
    <form method="POST" action="{{route('register')}}">
        @csrf
        <div class="form-group">
            <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" placeholder="Enter your fullname">
          </div><!-- name -->
          <div class="form-group">
            <input type="email" id="email" name="email" value="{{old('email')}}" class="form-control" placeholder="Enter your email">
          </div><!-- email -->
          <div class="form-group">
            <input type="password" class="form-control" id="password" name="password" value="{{__('Password')}}" placeholder="Enter your password">
          </div><!-- password -->
          <div class="form-group">
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" value="{{__('Confirm Password')}} placeholder="Re-type password">
          </div><!-- confirm-password -->
          <button type="submit" class="btn btn-info btn-block">Sign Up</button>
  
          <div class="mg-t-40 tx-center">Already registered? <a href="{{route('login')}}" class="tx-info">Sign In</a></div>
        </div><!-- login-wrapper -->
    </form>
@endsection