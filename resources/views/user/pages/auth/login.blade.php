@extends('layouts.master')

@section('title')
{{ $title ??'Login' }}
@endsection

@section('content')

<div class="formdiv">
          <form action="{{route('login-user')}}" method="POST">
                    @csrf
                    <h1>User Login</h1>
                    <hr>

                    <label for="username"><b>User Name</b></label>
                    <input type="text" placeholder="Enter User Name" name="name" id="username" required>


                    <label for="psw"><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="password" id="psw" required>

                    <button type="submit" class="actionbtn">Sign in</button>
          </form>
</div>

@endsection