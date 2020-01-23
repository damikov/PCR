<@extends("views.app")
@section("content")
<div class="container">
@if(session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Done !!! </strong>{{ session()->get('message') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
@endif
<div class="col-md-6">
<h1>Todo List</h1>
<form method="POST" action={{url('/task')}}>
{{csrf_field()}}
<div class="form-group">
<input type="text" class="form-control" name="task" placeholder="Enter Task" required>
<input type="text" class="form-control" name="description" maxlength="200" placeholder="Enter description" required>
    <input type="radio"  class="form-control" name="priority" value="low"> Low <br>
    <input type="radio"  class="form-control" name="priority" value="medium"> Medium <br>
    <input type="radio"  class="form-control" name="priority" value="high"> High <br>
    <input type="radio"  class="form-control" name="priority" value="critical"> Critical <br>
<input type="text" class="form-control" name="personAssigned" maxlength="100" placeholder="Enter person assigned" required>
<input type="text" class="form-control" name="dueDate" maxlength="9" placeholder="xx/x/xxx" required>  
    <input type="radio"  class="form-control" name="status" value="Pending"> Pending <br>
    <input type="radio"  class="form-control" name="status" value="In-Progress"> In-Progress <br>
    <input type="radio"  class="form-control" name="status" value="Completed"> Completed <br>
</div>
<div class="form-group">
<button type="submit" class="btn btn-success">Add</button>
</div>
</form>
<hr>
<ol>
<h1>Tasks</h1>
@foreach($tasks as $task)
<li><p> {{ $task->task}}</p><p>Description: {{ $task->description}}</p><p>Priority: {{ $task->Priority}}</p><p>Person Assigned: {{ $task->personAssigned}}</p>
<p>Due Date: {{ $task->dueDate}}</p> <p>Status: {{ $task->status}}</p>  <p>Created Date: {{ $task->created_at}}</p> <p>Updated Date: {{ $task->updated_at}}</p>
<h4> Enter Below info to edit </h4>
<form method="POST" action={{url('/'.$task->id.'/edit')}}>
{{csrf_field()}}
<div class="form-group">
<input type="text" class="form-control" name="description" maxlength="200" placeholder="Enter description" required>
    <input type="radio"  class="form-control" name="priority" value="low"> Low <br>
    <input type="radio"  class="form-control" name="priority" value="medium"> Medium <br>
    <input type="radio"  class="form-control" name="priority" value="high"> High <br>
    <input type="radio"  class="form-control" name="priority" value="critical"> Critical <br>
<input type="text" class="form-control" name="dueDate" maxlength="9" placeholder="xx/x/xxx" required>  
    <input type="radio"  class="form-control" name="status" value="Pending"> Pending <br>
    <input type="radio"  class="form-control" name="status" value="In-Progress"> In-Progress <br>
    <input type="radio"  class="form-control" name="status" value="Completed"> Completed <br> 
</div>
<div class="form-group">
<button type="submit" class="btn btn-success">Edit</button>
</div>
<a href = {{url('/'.$task->id.'/complete')}}> Complete </a>
<a href ={{url('/'.$task->id.'/delete')}}>Delete</a>
</li>
@endforeach
</ol>
<h1>Completed</h1>
<ol>
@foreach($completed_tasks as $c_task)
<li><a href ={{url('/'.$c_task->id.'/delete')}}>{{ $c_task->task }}</a></li>
@endforeach
</ol>
</div>
</div>
@endsection
