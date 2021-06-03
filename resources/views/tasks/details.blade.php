@extends('layouts.main-layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    @if($task->status == 'todo')
                        Task - <span class="c-task__single-task-status c-task__single-task-status--todo">{{ $task->status }}</span>
                    @endif
                    
                    @if($task->status == 'completed')
                        Task - <span class="c-task__single-task-status c-task__single-task-status--completed">{{ $task->status }}</span>
                    @endif
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $task->name }}</h5>
                    <p class="card-text">{{ $task->description }}</p>
                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary">Edit</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection