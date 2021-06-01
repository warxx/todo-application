@extends('layouts.main-layout')

@section('content')
<div>
    <h3>this is list of all tasks</h3>

    @foreach($tasks as $task)
        <div">
            <p>ID: {{ $task['id'] }}</p>
            <p>Name: {{ $task['name'] }}</p>
            <p>Description: {{ $task['description'] }}</p>
        </div>
    @endforeach
<div>
@endsection