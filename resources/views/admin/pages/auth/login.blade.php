@extends('layouts.master')

@section('title')
{{ $title ??'Login-Admin' }}
@endsection

@section('content')

<div class="formdiv">
          <form action="{{route('admin.login')}}" method="POST">
                    @csrf
                    <h1>Admin Login</h1>
                    <hr>

                    <label for="username"><b>Admin Name</b></label>
                    <input type="text" placeholder="Enter Admin Name" name="name" id="username" required>


                    <label for="psw"><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="password" id="psw" required>

                    <button type="submit" class="actionbtn primary">Sign in</button>
          </form>
</div>

@endsection