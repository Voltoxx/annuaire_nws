<?php
require_once __DIR__ . '/../init/init.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["id"]) && isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["email"]) && isset($_POST["telephone"]) && isset($_POST["specialitees"])) {
        $id = $_POST["id"];
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $email = $_POST["email"];
        $telephone = $_POST["telephone"];
        $specialite = $_POST["specialitees"];

        $contactController->updateContact($id, $nom, $prenom, $email, $telephone, $specialite);

        header("Location: contacts_list.php");
        exit();
    }
}
