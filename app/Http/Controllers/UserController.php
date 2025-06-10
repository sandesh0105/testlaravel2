<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function welcome(){
        return view('users.welcome');
    }

    public function index(){
        if (!Auth::check()) {
            return redirect()->route('user.welcome');
        }
        $users = User::all();
        return view('users.index',['users'=> $users]); 
    }

    public function showLogin(){
        return view('users.login'); 
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('username', $credentials['username'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user);
            return redirect()->route('user.index')->with('success', 'Login successful!');
        }

        return back()->withErrors(['login' => 'Invalid username or password']);
    }

    public function showSignup(){
        return view('users.signup'); 
    }

    public function signup(Request $request){
        $data = $request->validate([
            'username' => 'required|unique:users,username',
            'password' => 'required|min:6',
            'dob' => 'required|date',
            'college' => 'required'
        ]);

        $data['password'] = Hash::make($data['password']);
        
        $newUser = User::create($data);
        Auth::login($newUser);
        
        return redirect()->route('user.index')->with('success', 'Account created successfully!');
    }

    public function edit(User $user){
        if (!Auth::check()) {
            return redirect()->route('user.welcome');
        }
        return view('users.edit',['user' => $user]);
    }

    public function update(User $user, Request $request){
        if (!Auth::check()) {
            return redirect()->route('user.welcome');
        }
        
        $data = $request->validate([
            'username' => 'required|unique:users,username,' . $user->id,
            'dob' => 'required|date',
            'college' => 'required'
        ]);

        // Only update password if provided
        if ($request->filled('password')) {
            $request->validate(['password' => 'min:6']);
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        return redirect()->route('user.index')->with('success','User Updated successfully');
    }

    public function destroy(User $user){
        if (!Auth::check()) {
            return redirect()->route('user.welcome');
        }
        
        $user->delete();
        return redirect()->route('user.index')->with('success','User Deleted successfully');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('user.welcome')->with('success', 'Logged out successfully!');
    }
}