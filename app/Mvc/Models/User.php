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
        // Collect form data
        $firstName = $_POST["fname"];
        $lastName = $_POST["lname"];
        $email = $_POST["email"];
        $country = $_POST["country"];
        $city = $_POST["city"];

        // Validate form data
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
            $this->actionResponse(true, 401, $errors, []);
        }

        // prepare sql query, prepare function returns object or false
        $prepared = $this->conn->prepare("INSERT INTO Users(FirstName, LastName, Email, Country, City, Created, Updated) VALUES(?, ?, ?, ?, ?, ?, ?)");

        if(!$prepared) {
            $errors[] = "SQL query is not prepared correctly.";
        }

        // current date and time
        $dateTime = date('Y-m-d H:i:s');

        // bind user input fields, bind_param function returns true or false
        $binded = $prepared->bind_param("sssssss", $firstName, $lastName, $email, $country, $city, $dateTime, $dateTime);

        if(!$binded) {
            $errors[] = "Form data is not binded correctly.";
        }

        // run query, execute function returns true or false
        $executed = $prepared->execute();

        if(!$executed) {
            $errors[] = "Data is not stored correctly.";
        }

        if($errors) {
            $this->actionResponse(true, 401, $errors, []);
        }

        // close prepared statement
        $prepared->close();

        // get user id
        $newUserId = $this->conn->insert_id; 

        // close db connection
        $this->conn->close();

        // Success message
        $success = ["User stored successfully, new user id is: $newUserId."];

        $this->actionResponse(false, 200, $success, []);
    }

    private function actionResponse($error, $code, $message, $data)
    {
        // Define final response
        $finalResponse = [];

        $response = [
            'error' => $error,
            'message' => $message,
            'data' => $data
        ];

        $finalResponse = json_encode($response);

        // set the appropriate headers
        header('Content-Type: application/json');

        // set the HTTP response code
        http_response_code($code);

        // Echo result
        echo $finalResponse;

        // Kill the script
        die();
    }

    public function allUsersForApi()
    {
        $users = $this->conn->query("SELECT * FROM Users");

        if(!$users) {
            $msg = ["User data not received."];
            $this->actionResponse(true, 401, $msg, []);
        }

        $this->conn->close();

        $data = [];

        if($users->num_rows > 0) {
            while($user = $users->fetch_object()) {
                $data[] = $user;
            }
        }

        $msg = ["User data received successfully."];

        $this->actionResponse(false, 200, $msg, $data);
    }
}