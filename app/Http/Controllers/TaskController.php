<?php

namespace App\Http\Controllers;

use App\Task;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TaskRepository;

class TaskController extends Controller
{
  /**
   * The task repository instance.
   *
   * @var TaskRepository
   */
  protected $tasks;

  /**
   * Create a new controller instance.
   *
   * @param  TaskRepository  $tasks
   * @return void
   */
  public function __construct(TaskRepository $tasks)
  {
    $this->middleware('auth');
    $this->tasks = $tasks;
  }

  /**
   * Display a list of all of the user's task.
   *
   * @param  Request  $request
   * @return Response
   */
  public function index(Request $request)
  {
    return view('tasks.index', [
      'tasks' => $this->tasks->forUser($request->user()),
    ]);
  }


  /**
   * Create a new task.
   *
   * @param  Request  $request
   * @return Response
   */
  public function store(Request $request)
  {
    // if validation fails the user will get automatically redirected to back
    $this->validate($request, [
        'name' => 'required|max:255',
    ]);

    // Create The Task...
    $request->user()->tasks()->create([
      'name' => $request->name,
      ]);

    return redirect('/tasks');
  }


  /**
   * Update a certain task.
   * 
   * @param Request $request
   * @param Task $task
   * @return Response
   */
  public function update(Request $request, Task $task)
  {
    $this->authorize('edit', $task);
    $task->resolved = ($request->resolved == "true");
    $task->save();

    return response()->json([
      'resolved' => $task->resolved]);
  }


  /**
   * Destroy the given task.
   *
   * @param  Request $request
   * @param  Task $task
   * @return Response
   */
  public function destroy(Request $request, Task $task)
  {
    // 1.arg: name of policy method, 2.arg: model instance
    $this->authorize('edit', $task);

    $task->delete();

    return redirect('/tasks');
  }  
}
