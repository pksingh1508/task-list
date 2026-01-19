<?php

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

Route::get('/tasks/{id}', function($id) {
    return view('show', ['task' => Task::findOrFail($id)]);
})->name('tasks.show');

// POST Request.
Route::post('/tasks', function(Request $request) {
    // sanitaize and validate the data
    $data = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'long_description' => 'required'
    ]);

    $task = new Task;
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];

    $task->save();
    return redirect()->route('tasks.show', ['id' => $task->id])->with('success', "Task created successfully");
})->name('tasks.store');


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