<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'list';

if ($page == 'add') {
    header('Location: views/add_contact.php');
} elseif ($page == 'list') {
    header('Location: views/contacts_list.php');
} else {
    header('Location: views/not_found.php');
}
