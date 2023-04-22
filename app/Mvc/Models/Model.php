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
}