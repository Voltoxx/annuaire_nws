<?php

class Database
{
    private $pdo;

    public function __construct($config)
    {
        if (empty($config['host']) || empty($config['username']) || empty($config['database'])) {
            throw new Exception("La configuration de la base de données est incomplète.");
        }

        $dsn = "mysql:host={$config['host']};dbname={$config['database']}";
        try {
            $this->pdo = new PDO($dsn, $config['username'], $config['password']);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new Exception("Erreur de connexion à la base de données: " . $e->getMessage());
        }
    }

    private function createContactObject($row)
    {
        return new Contact($row['id'], $row['nom'], $row['prenom'], $row['email'], $row['telephone'], $row['specialitees']);
    }

    public function addContact(Contact $contact)
    {
        try {
            $sql = "INSERT INTO contacts (nom, prenom, email, telephone, specialitees) VALUES (:nom, :prenom, :email, :telephone, :specialitees)";
            $stmt = $this->pdo->prepare($sql);

            $nom = htmlspecialchars($contact->getNom(), ENT_QUOTES, 'UTF-8');
            $prenom = htmlspecialchars($contact->getPrenom(), ENT_QUOTES, 'UTF-8');
            $email = filter_var($contact->getEmail(), FILTER_SANITIZE_EMAIL);
            $telephone = htmlspecialchars($contact->getTelephone(), ENT_QUOTES, 'UTF-8');
            $specialitees = htmlspecialchars($contact->getSpecialite(), ENT_QUOTES, 'UTF-8');

            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':telephone', $telephone);
            $stmt->bindParam(':specialitees', $specialitees);

            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de l'ajout du contact : " . $e->getMessage());
        }
    }

    public function updateContact(Contact $contact)
    {
        try {
            $sql = "UPDATE contacts SET nom = :nom, prenom = :prenom, email = :email, telephone = :telephone, specialitees = :specialitees WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);

            $nom = htmlspecialchars($contact->getNom(), ENT_QUOTES, 'UTF-8');
            $prenom = htmlspecialchars($contact->getPrenom(), ENT_QUOTES, 'UTF-8');
            $email = filter_var($contact->getEmail(), FILTER_SANITIZE_EMAIL);
            $telephone = htmlspecialchars($contact->getTelephone(), ENT_QUOTES, 'UTF-8');
            $specialitees = htmlspecialchars($contact->getSpecialite(), ENT_QUOTES, 'UTF-8');

            $stmt->bindParam(':id', $contact->getId());
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':telephone', $telephone);
            $stmt->bindParam(':specialitees', $specialitees);

            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la mise à jour du contact : " . $e->getMessage());
        }
    }

    public function deleteContact($contactId)
    {
        try {
            $sql = "DELETE FROM contacts WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);

            $stmt->bindParam(':id', $contactId);

            $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la suppression du contact : " . $e->getMessage());
        }
    }

    public function getContactById($contactId)
    {
        try {
            $sql = "SELECT * FROM contacts WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);

            $stmt->bindParam(':id', $contactId);

            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            return $this->createContactObject($row);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération du contact : " . $e->getMessage());
        }
    }

    public function getAllContacts()
    {
        $sql = "SELECT * FROM contacts";
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();

        $contacts = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $contacts[] = $this->createContactObject($row);
        }

        return $contacts;
    }

    public function searchContacts($search)
    {
        try {
            $sql = "SELECT * FROM contacts WHERE nom LIKE :search OR prenom LIKE :search OR email LIKE :search OR telephone LIKE :search";
            $stmt = $this->pdo->prepare($sql);

            $search = "%{$search}%";
            $stmt->bindParam(':search', $search);

            $stmt->execute();

            $contacts = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $contacts[] = $this->createContactObject($row);
            }

            return $contacts;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la recherche des contacts : " . $e->getMessage());
        }
    }

    public function filtreContacts($filtre)
    {
        try {
            $sql = "SELECT * FROM contacts ORDER BY {$filtre}";
            $stmt = $this->pdo->prepare($sql);

            $stmt->execute();

            $contacts = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $contacts[] = $this->createContactObject($row);
            }

            return $contacts;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors du filtrage des contacts : " . $e->getMessage());
        }
    }

    public function __destruct()
    {
        $this->closeConnection();
    }

    public function closeConnection()
    {
        $this->pdo = null;
    }
}
