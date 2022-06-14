<?php

namespace App\DataFixtures;

use App\Entity\RP;
use Faker\Factory;
use App\Entity\Module;
use App\Entity\Professeur;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProfesseurModuleFixtures extends Fixture
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
            $module = new Module();
            $module->setLibelle("Algo".$i);
            $manager->persist($module);
        }

        $prof= new Professeur();
        $prof->setNomComplet($faker->firstName()." ".$faker->lastName());
        $prof->setGrade("Technicien");
        $prof->setRP($rp);
        $prof->addModule($module);
        $prof->setRole('ROLE_PROFESSEUR');
        $manager->persist($prof);

        $manager->flush();
    }
}
