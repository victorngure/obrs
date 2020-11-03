<?php

namespace App\Http\Controllers;

use App\TaskComments;
use App\Tasks;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskCommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $this->validate($request, [
            'comment' => 'required'
        ]);

        $task = Tasks::find($request->id);

        $task->taskcomments()->saveMany([
            new \App\TaskComments(['title' => $request->comment,'date' => Carbon::today()->toDateString()])
        ]);    

        return redirect()->route('task.index')->with('success','Comments added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TaskComments  $taskComments
     * @return \Illuminate\Http\Response
     */
    public function show(TaskComments $taskComments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TaskComments  $taskComments
     * @return \Illuminate\Http\Response
     */
    public function edit(TaskComments $taskComments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TaskComments  $taskComments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TaskComments $taskComments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TaskComments  $taskComments
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaskComments $taskComments)
    {
        //
    }
}
