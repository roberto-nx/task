<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller
{

    public function home()
    {
      
        
      return Inertia::render('task');
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
            'task' => $request->task,
            'task_description' => $request->taskdescription,
            'priority' => $request->priority,
        ]);
        
        
            return response()->json(
             [
                 'message'=>"tarefa criada com sucesso",
                 'task' =>$taskcreate
             ],200
            );
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $index=Task::All()
        ->sortBy('priority');
       
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
        
        $olldtask=Task::where('id', $request->id)->first();
        $task=Task::where('id', $request->id)
            ->update([  
            'task' => $request->task??$olldtask->task,
            'task_description' => $request->taskdescription??$olldtask->task_description,
            'priority' => $request->priority??$olldtask->priority,]);

        
        return response()->json(
            [
                'message' =>'tarefa atualizada com sucesso',
                'tarefa'=>$task
            ],200
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $delete = Task::where('id', $id)->delete();
       
        return response()->json(
            [
                'message'=>'tarefa deletada com sucesso',
            ],200
        );
    }
}
