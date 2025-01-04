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
        <form action="{{route('tasks.store')}}" method='POST' class="form">
            @csrf
            <label for="">Title :</label>
            <input type="text" name='title'>
            <label for="">Description :</label>
            <textarea name="description" ></textarea>
            <p>
                @if(@session($message))
                {{session('message')}}
                @endif
            </p>
            <input type="submit" value="Create">
        </form>
    @endsection
</body>
</html>