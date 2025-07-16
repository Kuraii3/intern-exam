<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    //Display a list of all users
    public function index(){
        $users = User::all();
        return view('users.index', compact('users'));
    }

    //Display a form to create a new user 
    public function create(){
        return view('users.create');
    }

    //Store a new user in the database
    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'active' => $request->has('active') ? $request->active : true,
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    //Display a form to edit an existing user
    public function edit($id){
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    //Update an existing user in the database
    public function update(Request $request, $id){
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
            'active' => $request->has('active') ? $request->active : true,
        ]); 

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    //Delete a user from the database
    public function destroy($id){
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    //Display a list of all active users
    public function activeUsers(){
        $users = User::where('active', true)->get();
        return view('users.active', compact('users'));
    }
        
}
