<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function register()
    {
        return view('user.register', ['title' => 'Register']);
    }

    public function userRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5',
        ],[
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'password.required' => 'The password field is required.',
        ]);

        try {
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
    
            $user->save();
    
            return redirect()->route('user.login')->with('success', 'Registration successful. Please log in.');
        } catch (\Exception $e) {
            return redirect()->route('user.register')->with('error', 'Registration failed. Please try again.');
        }
    }

    public function login(): Response
    {
        return response()->view("user.login", ["title" => "Login"]);
    }

    public function userLogin(Request $request): Response | RedirectResponse
    {
        $email = $request->input('email');
        $password = $request->input('password');

        if (empty($email) || empty($password)) {
            return response()->view("user.login", [
                "title" => "Login",
                "error" => "Email or password cannot be empty"
            ]);
        }

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $request->session()->put("user", $email);
            return redirect()->route('todos.index')->with('success', 'Registration successful. Please log in.');
        }

        return response()->view("user.login", [
            "title" => "Login",
            "error" => "Email or password is incorrect"
        ]);
    }



    public function userLogout(Request $request): RedirectResponse
    {
        $request->session()->forget("user");
        return redirect()->route('user.login')->with('success', 'Logged out successfully.');
    }

    public function showProfile()
    {
        $user = auth()->user();
    
        $todos = $user->todos;
    
        return view('user.profile', ['todos' => $todos]);
    }

    public function index()
    {
        $user = auth()->user();
        $todos = $user->todos; 

        return view('your.view.name', compact('todos'));
    }

    public function changePassword()
    {
    return view('change-password');
    }

    public function updatePassword(Request $request)
        {
            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|min:8|confirmed',
            ]);

            $user = auth()->user();

            if (!Hash::check($request->input('current_password'), $user->password)) {
                return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.']);
            }

            $user->update(['password' => Hash::make($request->input('new_password'))]);

            return redirect()->back()->with('success', 'Password changed successfully.');
        }
}