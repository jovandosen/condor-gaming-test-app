<?php

use App\Mvc\Controllers\UserController;

$userController = new UserController();

$users = $userController->getAllUsers();

require_once __DIR__ . '/../app/Mvc/Views/all-users.php';