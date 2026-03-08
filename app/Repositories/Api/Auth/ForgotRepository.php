<?php

namespace App\Repositories\Api\Auth;

use App\Models\User;
use Fisal\Otp\Otp;

class ForgotRepository
{
    protected $otp;

    public function __construct()
    {
        $this->otp = new Otp();
    }




    public function getUserByEmail($email)
    {
        return User::where('email', $email)->first();
    }




    public function verifyOtp($data)
    {
        return $this->otp->validate($data['email'], $data['token']);
    }




    public function resetPassword($data)
    {
        $user = $this->getUserByEmail($data['email']);
        if (!$user) return false;
        $user->password = bcrypt($data['password']);
        $user->save();
        return $user;
    }
}
