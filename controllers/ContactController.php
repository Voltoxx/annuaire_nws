<?php
require_once __DIR__ . '/../models/Contact.php';
require_once __DIR__ . '/../models/Database.php';

class ContactController
{
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function addContact($nom, $prenom, $email, $telephone)
    {
        try {
            $contact = new Contact(null, $nom, $prenom, $email, $telephone);
            $this->db->addContact($contact);
        } catch (InvalidArgumentException $e) {
            return ["error" => $e->getMessage()];
        } catch (Exception $e) {
            return ["error" => "Une erreur s'est produite lors de l'ajout du contact."];
        }
    }

    public function updateContact($id, $nom, $prenom, $email, $telephone)
    {
        try {
            $contact = $this->db->getContactById($id);

            $contact->setNom($nom);
            $contact->setPrenom($prenom);
            $contact->setEmail($email);
            $contact->setTelephone($telephone);

            $this->db->updateContact($contact);
        } catch (Exception $e) {
            return ["error" => $e->getMessage()];
        }
    }

    public function deleteContact($id)
    {
        try {
            $this->db->deleteContact($id);
        } catch (Exception $e) {
            return ["error" => $e->getMessage()];
        }
    }


    public function getContactById($id)
    {
        try {
            return $this->db->getContactById($id);
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
            return null;
        }
    }


    public function getAllContacts()
    {
        try {
            return $this->db->getAllContacts();
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
            return [];
        }
    }

    public function searchContacts($search)
    {
        try {
            return $this->db->searchContacts($search);
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
            return [];
        }
    }

    public function filtreContacts($filtre)
    {
        try {
            return $this->db->filtreContacts($filtre);
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
            return [];
        }
    }
}
