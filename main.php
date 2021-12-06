<?php

require_once __DIR__ . '/include/vendor/autoload.php';
require_once __DIR__ . '/src/Database/Database.php';

$db = new \Chene\Database\Database();

$db->install();
$db->initEngines();
$db->uninstall();
