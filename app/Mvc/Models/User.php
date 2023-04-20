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
        $firstName = $_POST["fname"];
        $lastName = $_POST["lname"];
        $email = $_POST["email"];
        $country = $_POST["country"];
        $city = $_POST["city"];

        // validate form data
        $errors = [];

        if(empty($firstName)) {
            $errors[] = "First Name can not be empty.";
        }

        if(empty($lastName)) {
            $errors[] = "Last Name can not be empty.";
        }

        if(empty($email)) {
            $errors[] = "Email can not be empty.";
        }

        if($errors) {
            echo 'ERRORS';
            die();
        }

        // prepare sql query, prepare function returns object or false
        $prepared = $this->conn->prepare("INSERT INTO Users(FirstName, LastName, Email, Country, City, Created, Updated) VALUES(?, ?, ?, ?, ?, ?, ?)");

        // current date and time
        $dateTime = date('Y-m-d H:i:s');

        // bind user input fields, bind_param function returns true or false
        $binded = $prepared->bind_param("sssssss", $firstName, $lastName, $email, $country, $city, $dateTime, $dateTime);

        //

        // run query, execute function returns true or false
        $executed = $prepared->execute();

        // if executed
        if($executed) {
            // close prepared statement
            $prepared->close();

            // get user id
            $newUserId = $this->conn->insert_id; 

            // close db connection
            $this->conn->close();

            return [
                'id' => $newUserId
            ];
        }

        //
    }
}