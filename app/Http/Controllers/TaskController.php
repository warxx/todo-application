<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Status;
use App\Models\Task;

use Illuminate\Support\Facades\Auth;

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
        $todo_tasks = Task::where('status', Task::todo)->get();
        $completed_tasks = Task::where('status', Task::completed)->get();
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
        //validation
        $request->validate([
            'name' => ['required', 'string', 'min:4', 'max:100'],
            'description' => ['required', 'string', 'min:4', 'max:255'],
            'project' => ['required', 'numeric', 'exists:projects,id'],
        ]);

        $task = new Task();

        $user = Auth::user();

        $task->name = $request->name;
        $task->description = $request->description;
        $task->user()->associate($user->getKey());
        $task->status = Task::todo;
        $task->project_id = $request->project;

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
        $task = Task::findOrFail($id);

        return view('tasks.details', ['task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);

        return view('tasks.edit', ['task' => $task]);
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
        $task = Task::findOrFail($id);

        $task->name = $request->name;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->save();

        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Task::findOrFail($id)->delete();

        return response()->json(['response'=> 'Successfully deleted!']);
    }

    public function changeTaskStatus(Request $request) {
        $task_id = $request->id;

        $task = Task::findOrFail($task_id);
        $task->status = $request->status;
        $task->save();

        return response()->json(['task'=> $task]);
    }
}