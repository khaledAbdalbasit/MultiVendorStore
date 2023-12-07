<?php
namespace App\Actions\Fortify;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticateUser
{
    public function authenticate($requset)
    {
        $username = $requset->post( config('fortify.username'));
        $password = $requset->post('password');

        $user = Admin::where('username','=',$username)
            ->orWhere('email', '=', $username)
            ->orWhere('phone_number', '=', $username)
            ->first();

        if($user && Hash::check($password , $user->password))
        {
            return $user;
        }
 
        return false;
    }
}

