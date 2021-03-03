<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    private static $status = ['toDo', 'inProgress', 'done'];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->is_admin == 1) {
            $tasks = Task::latest()->paginate(5);
        } else {
            $tasks = Task::latest()->where('user_id', Auth::user()->id)->paginate(5);
        }

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $array = static::$status;
        
        if (Auth::user()->is_admin == 1) {
            $comments = Comment::latest()->where('task_id', $task->id)->with(['user'])->paginate(10);
        } else {
            $comments = Comment::latest()->with(['user'])->where('user_id', Auth::user()->id)->paginate(10);
        }   

        return view('tasks.show', compact('task', 'comments', 'array'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $users = DB::table('users')->where('is_admin', 0)->pluck('id','name');
        $projects = DB::table('projects')->pluck('id','name');

        return view('tasks.edit',compact('task', 'users', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            
            'name' => 'required',
            'description' => 'required',
     
        ]);
    
        $task->update($request->all());
    
        return redirect()->route('tasks.index')
            ->with('success','Task updated successfully');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
    
        return redirect('tasks.index')
            ->with('success', 'The task was successfully deleted');
    }

    /**
     * Change task status
     */
    public function changeTaskStatus(Request $request)
    {
        $task = Task::find($request->task_id);
        $task->status = $request->status;
        $task->save();
  
        return response()->json(['success'=>'Status changed successfully.']);
    }
}
