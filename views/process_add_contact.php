<?php
require_once __DIR__ . '/../init/init.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["email"]) && isset($_POST["telephone"])) {
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $email = $_POST["email"];
        $telephone = $_POST["telephone"];

        $contactController->addContact($nom, $prenom, $email, $telephone);

        header("Location: contacts_list.php");
        exit();
    }
}
