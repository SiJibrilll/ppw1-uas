<?php
$root = __DIR__ . "/../";

require_once __DIR__ . '/../app/Autoloader.php';

Autoloader::register();

require_once $root . "app/Dbh.php";
require_once $root . "app/router.php";
