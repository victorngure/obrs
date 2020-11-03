<?php

namespace App\Http\Controllers;

use App\Tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Tasks::all();
        return view('index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'date' => 'required',
            'user' => 'required',
            'description' => 'required'
        ]);

        $task = new Tasks();
        $task->name = $request->name;
        $task->date = $request->date;
        $task->user = $request->user;
        $task->description = $request->description;

        $task->save();

        return redirect()->route('task.index')->with('success','Task created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Tasks::with('taskcomments')->find($id);

        return view('show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Tasks::find($id);

        return view('edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();


        $this->validate($request, [
            'name' => 'required',
            'date' => 'required',
            'user' => 'required',
            'description' => 'required'
        ]);

        $task = Tasks::find($id);

        $task->name = $input['name'];
        $task->date = $input['date'];
        $task->user = $input['user'];
        $task->description = $input['description'];

        $task->save();

        return redirect()->route('task.index')->with('success','Task updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Tasks::find($id);

        $task->delete();

        return redirect()->route('task.index')->with('success','Task deleted successfully');
    }
}
