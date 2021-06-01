<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Status;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        // get data from db
        $todo_tasks = Task::where('status_id', '3')->get();
        $completed_tasks = Task::where('status_id', '4')->get();
        //$tasks = Task::orderBy('name', 'desc')->get();
        //$tasks = Task::where('name', 'first project')->get();
        //$tasks = Task::latest()->get();

        return view('tasks.all', ['todo_tasks' => $todo_tasks, 'completed_tasks' => $completed_tasks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = Project::all();

        return view('tasks.create', ['projects' => $projects]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = new Task();

        $user_id = auth()->user()->id; 
        $status_id = Status::where('name', 'todo')->first()['id'];

        $task->name = $request->name;
        $task->description = $request->description;
        $task->status_id = $status_id;
        $task->user_id = $user_id;
        $task->project_id = $request->projects;

        $task->save();

        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
