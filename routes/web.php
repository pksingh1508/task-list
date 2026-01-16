<?php

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function() {
    return redirect()->route('tasks.index');
});

// use all() -> to return all data from the model or see docs in database query builder in laravel
// use latest() -> to return data ordered by created_at descending
Route::get('/tasks', function () {
    return view('index', [
        "tasks" => \App\Models\Task::latest()->get()
    ]);
})->name('tasks.index');

Route::get('/tasks/{id}', function($id) {
    return view('show', ['task' => \App\Models\Task::findOrFail($id)]);
})->name('tasks.show');


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