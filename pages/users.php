<?php

use App\Mvc\Controllers\UserController;

$userController = new UserController();

$users = $userController->getAllUsers();

if(isset($_POST["add_user"])) {
    $userController = new UserController();
    $response = $userController->storeUserData();
    var_dump($response);
}

require_once __DIR__ . '/../app/Mvc/Views/all-users.php';