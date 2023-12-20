<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function register()
    {
        return view('user.register',['title' => 'Register']);
    }
    public function userRegister(Request $request)
    {
        return request()->all();

        // $request->validate([
        //     'name' => 'required|max:255',
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required|min:5',
        // ]);

    }

    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function Login():response
    {
        return response()->view("user.login",["title"=>"login"]);
    }

    public function UserLogin(Request $request):response|RedirectResponse
    {
        $user = $request->input('user');
        $password = $request->input('password');

        if(empty($user) || empty($password))
        {
            return response()->view("user.login",[
                "title" => "Login",
                "error" => "User or password cannot be empty"
            ]);
        }

        if($this->userService->login($user, $password)){
            $request->session()->put("user", $user);
            return redirect("/index");
        }

        return response()->view("user.login",[
            "title" => "Login",
            "error" => "User or password is incorrect"
        ]);
    }

    public function UserLogout()
    {

    }


}
