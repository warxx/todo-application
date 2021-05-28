@extends('layouts.main-layout')

@section('content')
<div>
    <h3>this is list of all projects</h3>

    @foreach($projects as $project)
        <div">
            <p>ID: {{ $project['id'] }}</p>
            <p>Name: {{ $project['name'] }}</p>
            <p>Description: {{ $project['description'] }}</p>
        </div>
    @endforeach
<div>
@endsection