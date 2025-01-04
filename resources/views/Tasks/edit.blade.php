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
    <section>
        <form action="{{route('tasks.update',$task->id)}}" class='form' method='POST'>
            @csrf 
            @method('PUT')
            <label for="">Title :</label>
            <input type="text" name="title" value='{{$task->title}}'>
            <label for="">Description :</label>
            <textarea name="description" >{{$task->description}}</textarea>
            <p>
                @if(@session($message))
                {{session('message')}}
                @endif
            </p>
            <input type="submit" value="Update">
        </form>
    </section>
    @endsection
</body>
</html>