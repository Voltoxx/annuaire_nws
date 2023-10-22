<?php
require_once __DIR__ . '/../init/init.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["id"]) && isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["email"]) && isset($_POST["telephone"])) {
        $id = $_POST["id"];
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $email = $_POST["email"];
        $telephone = $_POST["telephone"];

        $contactController->updateContact($id, $nom, $prenom, $email, $telephone);

        header("Location: contacts_list.php");
        exit();
    }
}
