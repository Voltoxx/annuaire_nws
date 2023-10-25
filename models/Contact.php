<?php
class Contact
{
    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $telephone;
    private $specialite;

    public function __construct($id, $nom, $prenom, $email, $telephone, $specialite)
    {
        $this->id = $id;
        $this->setNom($nom);
        $this->setPrenom($prenom);
        $this->setEmail($email);
        $this->setTelephone($telephone);
        $this->setSpecialite($specialite);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom)
    {
        $this->nom = $nom;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom)
    {
        $this->prenom = $prenom;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
        } else {
            throw new InvalidArgumentException("Adresse email invalide");
        }
    }

    public function getTelephone(): string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone)
    {
        $this->telephone = $telephone;
    }

    public function getSpecialite(): string
    {
        return $this->specialite;
    }

    public function setSpecialite(string $specialite)
    {
        $this->specialite = $specialite;
    }

    public function getDetails(): array
    {
        return [
            'ID' => $this->id,
            'Nom' => $this->nom,
            'Prénom' => $this->prenom,
            'Email' => $this->email,
            'Téléphone' => $this->telephone,
            'Spécialité' => $this->specialite
        ];
    }
}
