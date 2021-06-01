@extends('layouts.main-layout')

@section('content')
<div>
    these are details of single projects
    <p>Project Id - {{ $project->id }}</p>
    <p>Project Name - {{ $project->name }}</p>
    <p>Project Description - {{ $project->description }}</p>
<div>
@endsection