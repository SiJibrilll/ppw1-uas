<?php
$root = __DIR__ . "/../";
$GLOBALS['placeholder'] = '/uploads/placeholder.webp';

require_once __DIR__ . '/../app/Autoloader.php';

Autoloader::register();

require_once $root . "app/Dbh.php";
require_once $root . "app/router.php";
