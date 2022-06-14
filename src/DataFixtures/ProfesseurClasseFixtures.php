<?php

namespace App\DataFixtures;

use App\Entity\RP;
use Faker\Factory;
use App\Entity\Classe;
use App\Entity\Professeur;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProfesseurClasseFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $faker= Factory::create("fr_Fr");

        $rp =new RP();
        $rp->setNomComplet($faker->firstName()." ".$faker->lastName());
        $rp->setEmail($faker->email());
        $rp->setPassword($faker->password());
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

        $prof= new Professeur();
        $prof->setNomComplet($faker->firstName()." ".$faker->lastName());
        $prof->setGrade("Technicien");
        $prof->setRP($rp);
        $prof->addClass($classe);
        $prof->setRole('ROLE_PROFESSEUR');
        $manager->persist($prof);




        $manager->flush();
    }
}
