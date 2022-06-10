<?php

namespace App\Entity;


use App\Entity\AC;
use App\Entity\RP;
use App\Entity\Etudiant;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
#use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
#use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name:"type", type:"string")]
#[ORM\DiscriminatorMap(["rp" => "RP", "ac" =>
"AC","etudiant"=>"Etudiant"])]

class User extends Personne /* implements UserInterface,PasswordAuthenticatedUserInterface */
{

    #[ORM\Column(type: 'string', length: 50)]
    protected $login;

    #[ORM\Column(type: 'string', length: 50)]
    protected $password;

   
    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
}