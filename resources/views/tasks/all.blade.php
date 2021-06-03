@extends('layouts.main-layout')

@section('content')
<div class="container c-task">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="c-task__tasks-table-title">
                <h2>TODO Tasks</h2>
            </div>
            
            <table class="table c-tasks__table-todo">  
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Created at</th>
                        <th scope="col">Status</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>  
                @foreach($todo_tasks as $task)
                <tbody>
                    <tr class="c-tasks__table-row-todo">
                        <td class="c-tasks__table-row-id">{{ $task['id'] }}</td>
                        <td><a href="{{ route('tasks.show', $task['id']) }}" class="btn btn-link c-task__table-row-title">{{ $task['name'] }}</a></td>
                        <td>{{ $task['description'] }}</td>
                        <td>{{ $task['created_at'] }}</td>
                        <td class="c-tasks__table-row-status">{{ $task['status'] }}</td>
                        <td class="btn btn-link c-tasks__table-button">Complete</td>
                        <td class="c-task__remove-task-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </td>
                    </tr>
                </tbody>
                @endforeach
            </table>

            <div class="c-task__tasks-table-title">
                <h2>Completed Tasks</h2>    
            </div>
            <table class="table c-tasks__table-completed">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Created at</th>
                        <th scope="col">Status</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>  
                @foreach($completed_tasks as $task)
                <tbody>
                    <tr class="c-tasks__table-row-completed">
                        <td class="c-tasks__table-row-id">{{ $task['id'] }}</td>
                        <td><a href="{{ route('tasks.show', $task['id']) }}" class="btn btn-link c-task__table-row-title">{{ $task['name'] }}</a></td>
                        <td>{{ $task['description'] }}</td>
                        <td>{{ $task['created_at'] }}</td>
                        <td class="c-tasks__table-row-status">{{ $task['status'] }}</td>
                        <td class="btn btn-link c-tasks__table-button">Todo</td>
                        <td class="c-task__remove-task-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </td>
                    </tr>
                </tbody>
                @endforeach
            </table>

            <a href="{{ route('tasks.create') }}" class="btn btn-outline-primary">CREATE NEW TASK<a/>
        </div>
    </div>
</div>

<script type="text/javascript">

    $('.c-tasks__table-button').on('click', function(e){
        e.preventDefault();
        let currentStatus = $(this).parent().find('.c-tasks__table-row-status').text();
        switch(currentStatus) {
            case 'todo':
                changeStatus($(this), 'completed');
                break;
            case 'completed':
                changeStatus($(this), 'todo');
                break;
        }
        
    });

    $('.c-task__remove-task-btn svg').on('click', function(e){
        e.preventDefault();

        let currentRow = $(this).parent().parent().parent();
        deleteTask(currentRow);
    });

    function changeStatus(el, status) {
        
        let id = $(el).parent()
                        .find('.c-tasks__table-row-id')
                        .text();
        
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: 'POST',
            url:"{{ route('tasks.change-status') }}",
            data: {'status': status, 'id': id},
            success: function(data) {
                let row = $(el).parent().parent();
                moveRow(row, status);
            },
            error: function() {
            }
        })
    }

    function moveRow(el, status) {
        el.fadeOut(300, function() {
            $(this).remove();

            switch (status) {
                case 'completed':
                    $(this).appendTo('.c-tasks__table-completed'); 
                    let completeButton = $(this).find('.c-tasks__table-button');
                    $(completeButton).text('Todo');
                    $(this).find('.c-tasks__table-row-status').text('completed');
                    break;
                case 'todo':
                    $(this).appendTo('.c-tasks__table-todo');
                    let todoButton = $(this).find('.c-tasks__table-button');
                    $(todoButton).text('Complete');
                    $(this).find('.c-tasks__table-row-status').text('todo');
                    break;
            }
            $(this).fadeIn();
        });
    }

    function deleteTask(el) {
        let id = $(el).find('.c-tasks__table-row-id').text();

        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: 'DELETE',
            url:"/tasks/" + id,
            dataType: "JSON",
            data: {'delete': 'delete a task', "_method": 'DELETE'},
            success: function(data) {
                    el.fadeOut(300, function() {
                    $(this).remove();
                });
            },
            error: function() {
            }
        })
    }
</script>
@endsection