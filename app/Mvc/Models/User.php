<?php

namespace App\Mvc\Models;

use App\Mvc\Models\DbModel;

class User extends DbModel
{
    public function __construct()
    {
        parent::__construct();
    }

    public function allUsers()
    {
        $users = $this->conn->query("SELECT * FROM Users");

        $this->conn->close();

        return $users;
    }

    public function storeUser()
    {
        var_dump($_POST);
    }
}