<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index() {
        $users = User::all();
        return view('users.index', compact('users'));
    }
    public function showEdit($id) {
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }
    public function showAdd() {
        return view('users.add');
    }
    public function createUser(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|unique:users|max:255',
            'tim' => 'required|max:255',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,user',
        ]);

        $user = new User();
        $user->username = $validatedData['username'];
        $user->tim = $validatedData['tim'];
        $user->password = $validatedData['password'];
        $user->role = $validatedData['role'];
        $user->save();

        return redirect()->route('users.index')->with('message', 'User created successfully');
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'username' => 'required|unique:users,username,' . $id . '|max:255',
            'tim' => 'required|max:255',
            'password' => 'nullable|min:6',
            'role' => 'required|in:admin,user',
        ]);

        $user->username = $validatedData['username'];
        $user->tim = $validatedData['tim'];

        if (isset($validatedData['password']) && !empty($validatedData['password']) && trim($validatedData['password']) != '') {
            $user->password = $validatedData['password'];
        }
        $user->role = $validatedData['role'];
        $user->save();

        return redirect()->route('users.index')->with('message', 'User updated successfully');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('message', 'User deleted successfully');
    }
}
