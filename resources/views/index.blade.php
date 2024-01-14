@extends('layout.app')

@section('title','TODO LIST')


@section('sidebar')

<div class="header-container">


    @Auth
    <h2>welcome, {{ $user->name }}</h2>
    @endauth
    <form action="{{ route('logout') }}" method="post">
    @csrf
    <button type="submit">Logout</button>
    </form>
</div>

@endsection

@section('content')

    <div class="container">
       <div class="input-field">
            <form action="{{ route('store') }}" method="post">
                @csrf
                <textarea name="task" id="task" placeholder="Enter new task"></textarea>
                <button type="submit"><i class="uil uil-notes note-icon"></i></button>
            </form>
       </div>

        <form action="{{ route('delete') }}" method="post" class="">
            @csrf
             <ul class="todoLists">
                @foreach ($todo as $task)
                <li class="list">
                    <input type="checkbox" name="taskIds[]" value="{{ $task->id }}">
                    <span class="task">{{ $task->Task }}</span>

                </li>
                @endforeach
             </ul>
            <div class="delete-button">

                <button type="submit"><i class="uil uil-trash"></i></button>
            </div>
        </form>
    </div>

@endsection


