<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    /**
     * Display the user profile.
     */
    public function show()
    {
        $user = User::find(Session::get('user_id'));
        
        if (!$user) {
            return redirect('/login')->with('error', 'Please login to view your profile.');
        }

        // Get task statistics
        $taskCount = Task::where('user_id', $user->id)->count();
        $todayTaskCount = Task::where('user_id', $user->id)
            ->where('created_at', '>=', now()->startOfDay())
            ->count();
        $weekTaskCount = Task::where('user_id', $user->id)
            ->where('created_at', '>=', now()->startOfWeek())
            ->count();
        
        return view('profile.show', compact('user', 'taskCount', 'todayTaskCount', 'weekTaskCount'));
    }

    /**
     * Update the user profile.
     */
    public function update(Request $request)
    {
        $user = User::find(Session::get('user_id'));
        
        if (!$user) {
            return redirect('/login')->with('error', 'Please login to update your profile.');
        }

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $request->validate([
                'password' => 'min:6|confirmed'
            ]);
            $user->password = Hash::make($request->password);
        }

        $user->save();

        Session::put('user_name', $user->name);

        return back()->with('success', 'Profile updated successfully!');
    }
}
