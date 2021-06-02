@extends('layouts.main-layout')

@section('content')
<div class="container c-task">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="c-task__tasks-table-title">
                <h2>TODO Tasks</h2>
            </div>
            
            <table class="table">  
                <thead>
                    <tr>
                      <th scope="col">Nameee</th>
                      <th scope="col">Description</th>
                      <th scope="col">Created at</th>
                      <th></th>
                    </tr>
                </thead>  
                @foreach($todo_tasks as $task)
                <tbody>
                    <tr>
                        <td>{{ $task['name'] }}</td>
                        <td>{{ $task['description'] }}</td>
                        <td>{{ $task['created_at'] }}</td>
                        <td class="btn btn-link">Complete</td>
                    </tr>
                </tbody>
                @endforeach
            </table>

            <div class="c-task__tasks-table-title">
                <h2>Completed Tasks</h2>    
            </div>
            <table class="table">
                <thead>
                    <tr>
                      <th scope="col">Name</th>
                      <th scope="col">Description</th>
                      <th scope="col">Created at</th>
                      <th></th>
                    </tr>
                </thead>  
                @foreach($completed_tasks as $task)
                <tbody>
                    <tr>
                      <td>{{ $task['name'] }}</td>
                      <td>{{ $task['description'] }}</td>
                      <td>{{ $task['created_at'] }}</td>
                      <td class="btn btn-link">Complete</td>
                    </tr>
                </tbody>
                @endforeach
            </table>

            <a href="{{ route('tasks.create') }}" class="btn btn-outline-primary">CREATE NEW TASK<a/>
        </div>
    </div>
</div>
@endsection