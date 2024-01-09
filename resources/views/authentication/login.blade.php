@extends('layout.app')

@section('title','Login Page')

@section('sidebar')
<h1>This is the login page</h1>
<form action="{{ route('login') }}" method="post">
@csrf

<div>
    <label for="email">Email:</label>
    <input type="text" name="email" id="email" required>
</div>

<div>
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required>
</div>

<button type="submit">Login</button>

</form>
@endsection
