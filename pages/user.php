<?php

use App\Mvc\Controllers\UserController;

$userController = new UserController();

$user = $userController->getUserData();

var_dump($user);