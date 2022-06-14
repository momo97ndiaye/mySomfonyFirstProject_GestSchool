<?php

namespace App\Entity;

use App\Entity\User;
use App\Repository\ACRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: ACRepository::class)]
class AC extends User
{
   

    #[ORM\OneToMany(mappedBy: 'ac', targetEntity: Inscription::class)]
    private $inscriptions;

    public function __construct()
    {
        $this->inscriptions = new ArrayCollection();
    }

  
    /**
     * @return Collection<int, Inscription>
     */
    public function getInscriptions(): Collection
    {
        return $this->inscriptions;
    }

    public function addInscription(Inscription $inscription): self
    {
        if (!$this->inscriptions->contains($inscription)) {
            $this->inscriptions[] = $inscription;
            $inscription->setAc($this);
        }

        return $this;
    }

    public function removeInscription(Inscription $inscription): self
    {
        if ($this->inscriptions->removeElement($inscription)) {
            // set the owning side to null (unless already changed)
            if ($inscription->getAc() === $this) {
                $inscription->setAc(null);
            }
        }

        return $this;
    }
   /*  public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_AC';

        return array_unique($roles);
    }
 */
   /*  public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    } */
    public function __toString(): string{
        return $this->nomComplet;
    }


}
