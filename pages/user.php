<?php

use App\Mvc\Controllers\UserController;

$userController = new UserController();

if(isset($_POST["method"]) && $_POST["method"] == 'DELETE') {
    $userController->deleteUserData();
}

$user = $userController->getUserData();