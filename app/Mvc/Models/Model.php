<?php

namespace App\Mvc\Models;

// example of constructor property promotion 
class Model
{
    public function __construct(
        public string $name,
        public int $age,
        public ?string $email = null
    ) {}

    // example of Match Expression
    public function test($val)
    {
        $message = match($val) {
            "foo" => "Foo content",
            "bar" => "Bar content",
            "baz" => "Baz content",
            default => "Default content",
        };

        return $message;
    }
}