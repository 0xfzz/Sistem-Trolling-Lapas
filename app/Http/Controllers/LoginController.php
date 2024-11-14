<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function loginView(){
        return view('login');
    }
    public function loginCheck(Request $request){
        $username = $request->input('username');
        $password = $request->input('password');
        $user = User::firstWhere('username', $username);
        $match = $user ? Hash::check($password, $user->password) : false;
        if(!$match || !$user){
            return redirect()->back()->with('error', 'Invalid username or password');
        }
        Auth::login($user);
        return redirect()->route('home');
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
