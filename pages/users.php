<?php

use App\Mvc\Controllers\UserController;

$userController = new UserController();

$users = $userController->getAllUsers();

if(isset($_POST["add_user"])) {
    $userController = new UserController();
    $response = $userController->storeUserData();
}

if(isset($_POST["method"]) && $_POST["method"] == 'PATCH') {
    $userController->updateUserData();
}

require_once __DIR__ . '/../app/Mvc/Views/all-users.php';