<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Task;

class TaskController extends Controller
{
public function index(){
    $tasks = Task::where("status", "Pending")->orWhere("status", "In-Progress")->orderBy("id", "desc")->get();
    $completed_tasks = Task::where("status", "Completed")->get();
return view("welcome", compact("tasks", "completed_tasks"));
}
public function store(Request $request)
{
    
    $input = $request->all();
    $taskCheck = Task::where('task', '=',request("task"))->first();
    if ($taskCheck === null) {
        $message = "Task has been added";
        $task = new Task();
        $task->task = request("task");
        $task->description = request("description");
        $task->Priority = request("priority");
        $task->personAssigned = request("personAssigned");
        $task->dueDate = request("dueDate");
        $task->status = request("status");
        $task->save();
    }
    else{
        $message = "Error, Task already Exists";
    }
       
return Redirect::back()->with("message", $message);
}
public function edit(Request $request, $id)
{
    $input = $request->all();
    $task = Task::find($id);
    $task->description = request("description");
    $task->Priority = request("priority");
    $task->dueDate = request("dueDate");
    $task->updated_at = date('Y-m-d');
    $task->status = request("status");
    $task->save();
return Redirect::back()->with("message", "Task has been updated");
}
public function complete($id)
{
    $task = Task::find($id);
    $task->status = "Completed";
    $task->save();
return Redirect::back()->with("message", "Task has been added to completed list");
}
public function destroy($id)
{
    $task = Task::find($id);
    $task->delete();
return Redirect::back()->with('message', "Task has been deleted");
}
}
