<?php

use App\Mvc\Controllers\UserController;

$userController = new UserController();

if((isset($_POST["method"]) && $_POST["method"] == 'DELETE') || (isset($_POST["curl_delete_example"]))) {
    $userController->deleteUserData();
}

$user = $userController->getUserData();