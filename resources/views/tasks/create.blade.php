@extends('layouts.main-layout')

@section('content')
<div class="container c-task">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div>
                <h1 class="c-task__title">Create new task</h1>
            </div>
            <form action="{{ route('tasks.index') }}" method="POST" >
                @csrf
              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input name="name" type="text" class="form-control" id="name">
              </div>
              <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input name="description" type="text" class="form-control" id="description">
              </div>
              <div class="mb-3">
                <label for="project" class="form-label">Projects</label>
                <select name="project" class="form-control" id="project">
                    @foreach($projects as $project) {
                        <option value="{{ $project['id'] }}">{{ $project['name'] }}</option>
                    }
                    @endforeach
                </select>
              </div>
              <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
</div>

@endsection