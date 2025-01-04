@extends('Layout.app')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    @section('content')
    <div class="ContainerGlobal">
    <section class="Container">
        <h1>Todo List !</h1>
        <form action="{{route('tasks.index')}}">
            <input type="text" name="search" value="{{request('search')}}">
            <select name="filter">
                <option value="">All</option>
                <option value="1" {{request('filter')=='1'?'selected':''}} >Completed</option>
                <option value="0" {{request('filter')=='0'?'selected':''}}>Uncompleted</option>
            </select>
            <input type="submit" value="Filter">
        </form>
        @foreach($tasks as $task)
        <a href="{{route('tasks.show',$task->id)}}">
            <div class="Task">
                <form action="{{route('tasks.toggleStatus',$task)}}" method="post" class="checkbox-article">
                    @csrf
                    @method('PATCH')
                    <input type="checkbox" name="status" onchange="this.form.submit()" {{$task->status? 'checked':''}}>
                    <h3>{{$task->title}}</h3>
                </form>
                <article class="Buttons">
                    <form action="{{route('tasks.edit',$task->id)}}">
                        @csrf
                        <input type="submit" value="Edit">
                    </form>
                    <form action="{{route('tasks.destroy',$task->id)}}" method='POST'>
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Delete" >
                    </form>
                </article>
            </div>
        </a>
        @endforeach
        <div>
            <form action="{{route('tasks.create')}}">
                <input type="submit" value="Create">
            </form>
        </div>
    </section>
    </div>
    @endsection
</body>
</html>
