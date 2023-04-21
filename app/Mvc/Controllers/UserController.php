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
        return $user->storeUser();
    }

    public function getAllUsersForApi()
    {
        $user = new User();
        return $user->allUsersForApi();
    }

    public function getUserData()
    {
        $user = new User();
        return $user->getUserDataById();
    }

    public function deleteUserData()
    {
        $user = new User();
        return $user->deleteUserDataById();
    }

    public function updateUserData()
    {
        $user = new User();
        return $user->updateUser();
    }
}