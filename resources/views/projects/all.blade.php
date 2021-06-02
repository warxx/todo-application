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
                @foreach($projects as $project)
                <tbody>
                    <tr>
                        <td>{{ $project['name'] }}</td>
                        <td>{{ $project['description'] }}</td>
                        <td>{{ $project['created_at'] }}</td>
                    </tr>
                </tbody>
                @endforeach
            </table>

            <a href="{{ route('projects.create') }}" class="btn btn-outline-primary">CREATE NEW PROJECT<a/>
        </div>
    </div>
</div>
@endsection