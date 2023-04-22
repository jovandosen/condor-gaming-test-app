<?php

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, APP_URL . "/users");
curl_setopt($ch, CURLOPT_POST, 1);

curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
    'fname' => 'pera12',
    'lname' => 'peric12',
    'email' => 'pera12@gmail.com',
    'country' => 'Serbia12',
    'city' => 'Belgrade12',
    'curl_patch_example' => '',
    'userID' => '1'
)));

// Receive server response ...
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$serverResponse = curl_exec($ch);

curl_close($ch);

echo $serverResponse;