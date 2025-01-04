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
    <div class="Container">
        <section class="Task">
            <form action="{{route('tasks.toggleStatus',$task)}}" method='POST'  class="checkbox-article">
                @csrf
                @method('PATCH')
                <input type="checkbox" {{$task->status? 'checked':''}} name="status" onchange="this.form.submit()">
                <div class="description">
                    <h3>{{$task->title}}</h3>
                    <p>{{$task->description}}</p>
                </div> 
            </form>
            <article class="Buttons">
                <form action="{{route('tasks.edit',$task->id)}}" method="GET">
                    @csrf
                    <input type="submit" value="Edit">
                </form>
                <form action="{{route('tasks.destroy',$task->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Delete" >
                </form>
            </article>
        </section>
    </div>
    @endsection
</body>
</html>