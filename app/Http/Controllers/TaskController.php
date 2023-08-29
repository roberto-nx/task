<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{

    public function home()
    {
      return Inertia::render('task');
    }

    

    public function userHome()
    { 
        
        $id = Auth::id();
        $tasks=Task::where('user_id',$id)->get();
        
        return Inertia::render('taskUser', [
            'tasks'=>$tasks
                  ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $index=Task::All();
        
      return Inertia::render('task', [
        'tasks'=>$index
              ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $taskcreate = Task::create([
            'task' => $request->newtask,
            'amount' => $request->newtask_amount,
            'user_id' => Auth::id(),
            'task_description'=> $request->task_description,
        ]);
        
        
        return to_route('home.user');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $index=Task::All()
        ->sortBy('amount');
       
        return view('welcome',['tasks' => $index]);


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        
        $id = Auth::id();
        $olldtask=Task::where('id', $request->numbertask)->first();
        $task=Task::where('id', $request->numbertask)
            ->update([  
            'task' => $request->edit_task??$olldtask->task,
            'task_description' => $request->task_description??$olldtask->task_description,
            'amount' => $request->edit_amount??$olldtask->amount,
            'user_id' => Auth::id()]);
            

        
       return to_route('home.user');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
      
        $delete = Task::where('id', $id)->delete();
       
        return to_route('home.user');
    }
}
