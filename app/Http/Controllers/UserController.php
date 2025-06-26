<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $posts = $user->posts()->with('comments')->get();
        
        return view('user.show', compact('user', 'posts'));
    }

    public function manageRoles()
    {
        $users = User::with('roles')->get();
        $roles = Role::all();

        return view('user.roles', compact('users', 'roles'));
    }

    public function assignRole(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::find($request->user_id);
        $user->roles()->attach($request->role_id);

        return redirect()->route('user.roles');
    }

    public function removeRole(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::find($request->user_id);
        $user->roles()->detach($request->role_id);

        return redirect()->route('user.roles');
    }
}
