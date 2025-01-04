<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tasks=Task::query();
        if($request->has('search')){
            $tasks->where('title','like','%'.$request->search.'%');
        }
        if($request->has('filter')){
            if($request->filter=='1'){
                $tasks->where('status',true);
            }elseif($request->filter=='0'){
                $tasks->where('status',false);
            }
        }
        return view('Tasks.index',['tasks'=>$tasks->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Tasks.create');
    }
    public function toggleStatus(Task $task){
        $task->status=!$task->status;
        $task->save();
        return redirect()->route('tasks.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'title'=>'required',
            'description'=>'required'
        ]);
        if ($validator->fails()) { 
            return redirect()->route('tasks.create')->with('message','Entrer des valeurs valides!');
        }
        $task=new Task();
        $task->title=$request->title;
        $task->description=$request->description;
        $task->save();
        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task=Task::findOrFail($id);
        return view('Tasks.show',['task'=>$task]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $task=Task::findOrFail($id);
        return view('Tasks.edit',['task'=>$task]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $task=Task::findOrFail($id);
        $validator=Validator::make($request->all(),[
            'title'=>'required',
            'description'=>'required'
        ]);
        if ($validator->fails()) { 
            return redirect()->route('tasks.edit',$task->id)->with('message','Entrer des valeurs valides!');;
        }
        $task->title=$request->title;
        $task->description=$request->description;
        $task->save();
        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task=Task::findOrFail($id);
        $task->delete();
        return redirect()->route('tasks.index');
    }
}
