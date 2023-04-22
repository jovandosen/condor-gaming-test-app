<?php

use App\Mvc\Models\Model;
 
// Creating a new Model object
$model = new Model("Alice", 30, "alice@example.com");

// Accessing object properties
echo "Name: " . $model->name;
echo "Age: " . $model->age;
echo "Email: " . $model->email;

// example of Match Expression
echo $model->test('foo');