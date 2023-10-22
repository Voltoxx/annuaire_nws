<?php
require_once __DIR__ . '/../init/init.php';

$search = isset($_GET['search']) ? $_GET['search'] : '';
$filtre = isset($_GET['filtre']) ? $_GET['filtre'] : '';

if (!empty($search)) {
    $contacts = $contactController->searchContacts($search);
} elseif (!empty($filtre)) {
    $contacts = $contactController->filtreContacts($filtre);
} else {
    $contacts = $contactController->getAllContacts();
}

$content = "
<h1>Liste des contacts</h1>
<div class='center'>
    <div>
    <input type='text' id='search' name='search' placeholder='Rechercher un contact'>
    <button type='button' id='searchButton'>Rechercher</button>
    <script>
        document.getElementById('searchButton').addEventListener('click', function() {
            var search = document.getElementById('search').value;
            window.location.href = 'contacts_list.php?search=' + search;
        });
    </script>
    </div>
    <div>
    <select name='filtre' id='filtre'>
        <option value=''>Filtrer par...</option>
        <option value='id'>ID</option>
        <option value='nom'>Nom</option>
        <option value='prenom'>Prénom</option>
        <option value='email'>Email</option>
        <option value='telephone'>Téléphone</option>
    </select>
    <button type='button' id='filtreButton'>Filtrer</button>
    <script>
        document.getElementById('filtreButton').addEventListener('click', function() {
            var filtre = document.getElementById('filtre').value;
            window.location.href = 'contacts_list.php?filtre=' + filtre;
        });
    </script>
    </div>";

if (!empty($search)) {
    $content .= "
        <button type='button' id='undoSearchButton'>Annuler la recherche</button>
        <script>
            document.getElementById('undoSearchButton').addEventListener('click', function() {
                window.location.href = 'contacts_list.php';
            });
        </script>";
}

$content .= "</div>

<table>
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Email</th>
        <th>Téléphone</th>
        <th>Actions</th>
    </tr>";

if (!empty($contacts)) {
    foreach ($contacts as $contact) {
        $content .= "
        <tr>
            <td>" . $contact->getId() . "</td>
            <td>" . $contact->getNom() . "</td>
            <td>" . $contact->getPrenom() . "</td>
            <td>" . $contact->getEmail() . "</td>
            <td>" . $contact->getTelephone() . "</td>
            <td>
                <a href='edit_contact.php?id=" . $contact->getId() . "'>Modifier</a>
                <a href='process_delete_contact.php?id=" . $contact->getId() . "'>Supprimer</a>
            </td>
        </tr>";
    }
} else {
    $content .= "<tr><td colspan='6'>Aucun contact n'a été trouvé.</td></tr>";
}

$content .= "</table>
<div id='retour'>
<a href='add_contact.php'>Ajouter un contact</a>
</div>";

$title = 'Liste des contacts';
include __DIR__ . "/../layout/layout.php";
