<?php

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $tasks = Task::latest()->get();
    return view('welcome', compact('tasks'));
});

Route::post('/tasks', function (Request $request) {
    $request->validate(['title' => 'required|string|max:255']);

    Task::create([
        'title' => $request->title,
        'category' => $request->category ?? 'Personal',
        'priority' => $request->priority ?? 'Medium',
    ]);

    return redirect()->back();
});

Route::patch('/tasks/{task}/toggle', function (Task $task) {
    $task->update([
        'status' => $task->status === 'Pending' ? 'Completed' : 'Pending'
    ]);
    return redirect()->back();
});

Route::delete('/tasks/{task}', function (Task $task) {
    $task->delete();
    return redirect()->back();
});