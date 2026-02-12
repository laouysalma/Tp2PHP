<?php
declare(strict_types=1);

namespace App\Entity;

final class Etudiant
{
    private ?int $id;
    private string $name;       
    private string $email;
    private Filiere $filiere;

    public function __construct(?int $id, string $name, string $email, Filiere $filiere)
    {
        $this->setId($id);
        $this->setName($name);
        $this->setEmail($email);
        $this->setFiliere($filiere);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        if ($id !== null && $id <= 0) {
            throw new \InvalidArgumentException("Id de l'étudiant saisie est invalide.");
        }
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $name = trim($name);
        if ($name === '') {
            throw new \InvalidArgumentException("Le nom est obligatoire.");
        }
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $email = trim($email);
        if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("Email saisi non valide.");
        }
        $this->email = $email;
    }

    public function getFiliere(): Filiere
    {
        return $this->filiere;
    }

    public function setFiliere(Filiere $filiere): void
    {
        $this->filiere = $filiere;
    }
}
