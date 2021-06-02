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
                        <th scope="col">Nameee</th>
                        <th scope="col">Description</th>
                        <th scope="col">Created at</th>
                        <th scope="col">Status</th>
                        <th></th>
                    </tr>
                </thead>  
                @foreach($todo_tasks as $task)
                <tbody>
                    <tr class="c-tasks__table-row-todo">
                        <td class="c-tasks__table-row-id">{{ $task['id'] }}</td>
                        <td>{{ $task['name'] }}</td>
                        <td>{{ $task['description'] }}</td>
                        <td>{{ $task['created_at'] }}</td>
                        <td class="c-tasks__table-row-status">{{ $task['status'] }}</td>
                        <td class="btn btn-link c-tasks__table-button">Complete</td>
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
                    </tr>
                </thead>  
                @foreach($completed_tasks as $task)
                <tbody>
                    <tr class="c-tasks__table-row-completed">
                        <td class="c-tasks__table-row-id">{{ $task['id'] }}</td>
                        <td>{{ $task['name'] }}</td>
                        <td>{{ $task['description'] }}</td>
                        <td>{{ $task['created_at'] }}</td>
                        <td class="c-tasks__table-row-status">{{ $task['status'] }}</td>
                        <td class="btn btn-link c-tasks__table-button">Todo</td>
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
                    $(this).find('.c-tasks__table-row-status').text('complete');
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
</script>
@endsection