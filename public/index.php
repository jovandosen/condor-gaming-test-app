<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__. '/../config/app-config.php';
require_once __DIR__ . '/../config/db-config.php';

use App\Mvc\Controllers\Controller;
use App\Mvc\Models\Model;

require_once __DIR__ . '/../routes/routes.php';

// var_dump(new Controller());
// var_dump(new Model());