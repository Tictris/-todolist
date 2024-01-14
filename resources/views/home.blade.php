@extends('layout.app')

@section('title','HomePage')

@section('content')
<div class="out-container">
    <div>
        <div class="header">
            <h1>Welcome to my Todo List!</h1>
        </div>
            <div class="container-edit">
                <div class="user-button">
                    <a href="/register"><button >Register</button></a>
                    <a href="/login"><button >Login</button></a>
                </div>

            </div>
    </div>
</div>

@endsection
