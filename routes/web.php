<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Task;
use Illuminate\Http\Request;

Route::get('/', function () {
    $tasks = Task::orderBy('created_at', 'asc')->get();
    
    return view('tasks', [
      'tasks' => $tasks
    ]);
});


/* Add a new task */
Route::post('/task', function(Request $request){
  $validator = Validator::make($request->all(), [
    'name' => 'required|max:255',
  ]);

  if ($validator->fails()){
    return redirect('/')        // redirect to root
      ->withInput()             // and flash the old input and
      ->withErrors($validator); // the errors into the session (can be access via $errors in the view)
  }

  $task = new Task;
  $task->name = $request->name;
  $task->save();

  return redirect('/');
});


/* Delete an existing task */
Route::delete('/task/{id}', function($id){
  Task::findOrFail($id)->delete();

  return redirect('/');
});