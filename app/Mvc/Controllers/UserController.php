<?php

namespace App\Mvc\Controllers;

use App\Mvc\Models\User;

class UserController
{
    public function getAllUsers()
    {
        $user = new User();
        return $user->allUsers();
    }

    public function storeUserData()
    {
        $user = new User();
        $user->storeUser();
    }
}