<?php
require_once __DIR__ . '/../init/init.php';
$contactId = $_GET['id'];
$contact = $contactController->deleteContact($contactId);
header("Location: contacts_list.php");
exit();
