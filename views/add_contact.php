<?php

$content = "
<h1>Ajouter un contact</h1>
<div class='center'>
<form action='process_add_contact.php' method='post'>
    <div class='label'>
        <div>
        <label for='nom'>Nom</label>
        </div>
        <input type='text' name='nom' id='nom' required>
    </div>
    <div class='label'>
        <div>
        <label for='prenom'>Prénom</label>
        </div>
        <input type='text' name='prenom' id='prenom' required>
    </div>
    <div class='label'>
        <div>
        <label for='email'>Email</label>
        </div>
        <input type='email' name='email' id='email' required>
    </div>
    <div class='label'>
        <div>
        <label for='telephone'>Téléphone</label>
        </div>
        <input type='text' name='telephone' id='telephone' required>
    </div>
    <input type='submit' value='Ajouter'>
</form>
<a href='contacts_list.php'>Retour à la liste des contacts</a>
</div>
";
$title = 'Ajouter un contact';
include("../layout/layout.php");
