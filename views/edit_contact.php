<?php
require_once __DIR__ . '/../init/init.php';
$contactId = $_GET['id'];
$contact = $contactController->getContactById($contactId);
$content = "
<h1>Modifier un contact</h1>
<div class='center'>
    <form action='process_edit_contact.php' method='post'>
        <input type='hidden' name='id' id='id' value=" . $contact->getId() . ">
        <div class='label'>
            <div>
                <label for='nom'>Nom</label>
            </div>
            <input type='text' name='nom' id='nom' value=" . $contact->getNom() . " required>
        </div>
        <div class='label'>
            <div>
                <label for='prenom'>Prénom</label>
            </div>
            <input type='text' name='prenom' id='prenom' value=" . $contact->getPrenom() . " required>
        </div>

        <div class='label'>
            <div>
                <label for='email'>Email</label>
            </div>
            <input type='email' name='email' id='email' value=" . $contact->getEmail() . " required>
        </div>

        <div class='label'> 
            <div>
                <label for='telephone'>Téléphone</label>
            </div>
            <input type='text' name='telephone' id='telephone' value=" . $contact->getTelephone() . " required>
        </div>

        <input type='submit' value='Modifier'>
    </form>
    <a class='retour' href='contacts_list.php'>Retour à la liste des contacts</a>
</div>
";

$title = 'Modifier un contact';
include __DIR__ . "/../layout/layout.php";
