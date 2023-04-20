<?php

namespace App\Mvc\Models;

use App\Mvc\Models\DbModel;
use DOMDocument;
use Exception;

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
            $this->jsonResponse(true, 401, $errors, []);
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
            $this->jsonResponse(true, 401, $errors, []);
        }

        // close prepared statement
        $prepared->close();

        // get user id
        $newUserId = $this->conn->insert_id; 

        // close db connection
        $this->conn->close();

        // Success message
        $success = ["User stored successfully, new user id is: $newUserId."];

        $this->jsonResponse(false, 200, $success, []);
    }

    private function jsonResponse($error, $code, $message, $data)
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

    private function xmlResponse($code, $data)
    {
        // Create a new XML document
        $doc = new DOMDocument('1.0');

        // Create the root element
        $root = $doc->createElement('data');
        $root = $doc->appendChild($root);

        // Loop through each data item and create a new XML element for it
        foreach ($data as $item) {
            $dataItem = $doc->createElement('user');
            $dataItem = $root->appendChild($dataItem);
            
            $id = $doc->createElement('id');
            $id->appendChild($doc->createTextNode($item->ID));
            $dataItem->appendChild($id);
            
            $firstName = $doc->createElement('first-name');
            $firstName->appendChild($doc->createTextNode($item->FirstName));
            $dataItem->appendChild($firstName);
            
            $lastName = $doc->createElement('last-name');
            $lastName->appendChild($doc->createTextNode($item->LastName));
            $dataItem->appendChild($lastName);
            
            $email = $doc->createElement('email');
            $email->appendChild($doc->createTextNode($item->Email));
            $dataItem->appendChild($email);

            $country = $doc->createElement('country');
            $country->appendChild($doc->createTextNode($item->Country));
            $dataItem->appendChild($country);

            $city = $doc->createElement('city');
            $city->appendChild($doc->createTextNode($item->City));
            $dataItem->appendChild($city);

            $created = $doc->createElement('created');
            $created->appendChild($doc->createTextNode($item->Created));
            $dataItem->appendChild($created);

            $updated = $doc->createElement('updated');
            $updated->appendChild($doc->createTextNode($item->Updated));
            $dataItem->appendChild($updated);
        }

        // Set the content type header to XML
        header('Content-Type: text/xml');

        // set the HTTP response code
        http_response_code($code);

        // Output the XML document
        echo $doc->saveXML();

        // Kill the script
        die();
    }

    public function allUsersForApi()
    {
        $users = $this->conn->query("SELECT * FROM Users");

        if(DATA_FORMAT === 'json') {
            if(!$users) {
                $msg = ["User data not received."];
                $this->jsonResponse(true, 401, $msg, []);
            }
        } elseif(DATA_FORMAT === 'xml') {
            //
        }

        $this->conn->close();

        $data = [];

        if($users->num_rows > 0) {
            while($user = $users->fetch_object()) {
                $data[] = $user;
            }
        }

        $msg = ["User data received successfully."];

        if(DATA_FORMAT === 'json') {
            $this->jsonResponse(false, 200, $msg, $data);
        } elseif(DATA_FORMAT === 'xml') {
            $this->xmlResponse(200, $data);
        }
    }

    public function getUserDataById()
    {
        if(!isset($_POST["userID"])) {
            throw new Exception('User ID is not defined.');
        }

        $id = $_POST["userID"];

        // prepare sql
        $prepared = $this->conn->prepare("SELECT FirstName, LastName, Email, Country, City, Created, Updated FROM Users WHERE ID = ?");

        if(!$prepared) {
            throw new Exception('SQL query is not prepared correctly.');
        }

        // Bind id
        $binded = $prepared->bind_param("i", $id);

        if(!$binded) {
            throw new Exception('User ID is not binded correctly.');
        }

        // Run query
        $executed = $prepared->execute();

        if(!$executed) {
            throw new Exception('SQL query failed to execute.');
        }

        // Get result
        $result = $prepared->get_result();

        if(!$result) {
            throw new Exception('Error while getting data from db.');
        }    

        $user = $result->fetch_object();

        $prepared->close();

        $this->conn->close();

        return $user;
    }
}