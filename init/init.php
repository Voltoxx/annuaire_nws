<?php
require_once __DIR__ . '/../controllers/ContactController.php';

$config = json_decode(file_get_contents(__DIR__ . '/../config/config.json'), true);
$database = new Database($config);
$contactController = new ContactController($database);
