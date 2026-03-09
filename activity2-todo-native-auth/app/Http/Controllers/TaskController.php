<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TaskController extends Controller
{
    /**
     * Display a list of tasks for the authenticated user.
     */
    public function index()
    {
        $userId = Session::get('user_id');
        $tasks = Task::where('user_id', $userId)->orderBy('created_at', 'desc')->get();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new task.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created task in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255'
        ]);

        Task::create([
            'user_id' => Session::get('user_id'),
            'title' => $request->title
        ]);

        return redirect('/tasks')->with('success', 'Task created successfully!');
    }

    /**
     * Show the form for editing the specified task.
     */
    public function edit($id)
    {
        $task = Task::where('id', $id)
            ->where('user_id', Session::get('user_id'))
            ->first();

        if (!$task) {
            return redirect('/tasks')->with('error', 'Task not found or you do not have permission to edit it.');
        }

        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified task in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255'
        ]);

        $task = Task::where('id', $id)
            ->where('user_id', Session::get('user_id'))
            ->first();

        if (!$task) {
            return redirect('/tasks')->with('error', 'Task not found or you do not have permission to update it.');
        }

        $task->title = $request->title;
        $task->save();

        return redirect('/tasks')->with('success', 'Task updated successfully!');
    }

    /**
     * Remove the specified task from storage.
     */
    public function destroy($id)
    {
        $task = Task::where('id', $id)
            ->where('user_id', Session::get('user_id'))
            ->first();

        if (!$task) {
            return redirect('/tasks')->with('error', 'Task not found or you do not have permission to delete it.');
        }

        $task->delete();

        return redirect('/tasks')->with('success', 'Task deleted successfully!');
    }
}
