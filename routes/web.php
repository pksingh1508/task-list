<?php

use App\Http\Requests\TaskRequest;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function() {
    return redirect()->route('tasks.index');
});

// use all() -> to return all data from the model or see docs in database query builder in laravel
// use latest() -> to return data ordered by created_at descending
// we can also use clauses like -> where('completed', false) to filter data
Route::get('/tasks', function () {
    return view('index', [
        "tasks" => Task::latest()->get()
    ]);
})->name('tasks.index');

Route::view('/tasks/create', 'create')->name('tasks.create');

Route::get('/tasks/{task}/edit', function(Task $task) {
    return view('edit', ['task' => $task]);
})->name('tasks.edit');

Route::get('/tasks/{task}', function(Task $task) {
    return view('show', ['task' => $task]);
})->name('tasks.show');

// POST Request -> to insert the data.
Route::post('/tasks', function(TaskRequest $request) {
    // sanitaize and validate the data
    // $data = $request->validate([
    //     'title' => 'required|max:255',
    //     'description' => 'required',
    //     'long_description' => 'required'
    // ]);

    // $data = $request->validated();
    // $task = new Task;
    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description = $data['long_description'];
    // $task->save();

    $task = Task::create($request->validated());

    return redirect()->route('tasks.show', ['task' => $task->id])->with('success', "Task created successfully");
})->name('tasks.store');

// PUT Request - to update the single data.
Route::put('/tasks/{task}', function(Task $task, TaskRequest $request) {
    // sanitaize and validate the data
    // $data = $request->validate([
    //     'title' => 'required|max:255',
    //     'description' => 'required',
    //     'long_description' => 'required'
    // ]);

    // $data = $request->validated();
    // $task->title = $data['title'];
    // $task->description = $data['description'];
    // $task->long_description = $data['long_description'];
    // $task->save();

    $task->update($request->validated());

    return redirect()->route('tasks.show', ['task' => $task->id])->with('success', "Task updated successfully");
})->name('tasks.update');

// delete request - to delete a single data
Route::delete('/task/{task}', function(Task $task) {
    $task->delete();
    return redirect()->route('tasks.index')
        ->with('success', 'Task Deleted Successfully');
})->name('tasks.destroy'); 

// Route::get('/hello', function() {
//     return "This is hello page";
// })->name('This is route for the hello page.');

// Route::get('/greet/{name}', function($name) {
//     return 'Hello ' . $name . '!';
// });

// redirect
// Route::get('/hallo', function() {
//     return redirect('/hello');
// });

// GET = get the data
// POST = insert the data
// PUT = update the data
// DELETE = delete the data

// fallback route - when no route is matched.
Route::fallback(function() {
    return "Still got Somewhere.";
});