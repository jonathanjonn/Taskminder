<?php

namespace App\Services\Impl;

use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class UserServiceImpl implements UserService
{
  private array $users = ["todo1" => "todo1"];

  function login(string $user, string $password):bool
  {
    return Auth::attempt(['email' => $user, 'password' => $password]);
    // if(!isset($this->users[$user])){
    //   return false;
    // }

    // $correctPassword = $this->users[$user];
    // return $password == $correctPassword;
  }
}
