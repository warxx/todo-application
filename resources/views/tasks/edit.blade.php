@extends('layouts.main-layout')

@section('content')
<div class="container c-task">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div>
                <h1 class="c-task__title">Edit task</h1>
            </div>
            <form action="{{ route('tasks.update', $task->id) }}" method="POST" >
            <input type="hidden" name="_method" value="put">
                @csrf
              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input name="name" type="text" class="form-control" id="name" value="{{ $task->name }}">
              </div>
              <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input name="description" type="text" class="form-control" id="description" value="{{ $task->description }}">
              </div>
              <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" type="status" class="form-control" id="status"> 
                    <option value="todo">todo</option>
                    <option value="completed">completed</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="project" class="form-label">Project</label>
                    <input name="project" type="text" class="form-control" id="project" disabled value="{{ $task->project->name }}">
              </div>
              <button type="submit" class="btn btn-primary">Edit</button>
            </form>
        </div>
    </div>
</div>

@endsection