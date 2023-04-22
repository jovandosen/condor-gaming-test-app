<?php

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"http://condor-gaming-test-app.project/users-api");
curl_setopt($ch, CURLOPT_POST, 1);

// Receive server response ...
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$serverResponse = curl_exec($ch);

curl_close($ch);

echo $serverResponse;