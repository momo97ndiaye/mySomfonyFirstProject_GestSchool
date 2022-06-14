<?php

namespace App\DataFixtures;

use App\Entity\RP;
use Faker\Factory;
use Faker\Generator;
use App\Entity\Classe;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ClasseFixtures extends Fixture
{
    private Generator $faker;

    public function __construct(){
        $this->faker= Factory::create("fr_Fr");
    }

    public function load(ObjectManager $manager): void
    {
        $faker= Factory::create("fr_Fr");

        $rp =new RP();
        $rp->setNomComplet('Mamadou Ndiaye');
        $rp->setEmail($faker->email());
        $rp->setPassword('passer');
        $rp->setRole('ROLE_RP');
        $manager->persist($rp);
        for ($i=1; $i < 4; $i++) {  
            $classe = new Classe();
            $classe->SetRp($rp);
            $classe->SetNiveau("Licence".$i);
            $classe->SetLibelle("STIC".$i);
            $classe->SetFiliere("Informatique");
            $manager->persist($classe);
        }

        $manager->flush();
    }
}
