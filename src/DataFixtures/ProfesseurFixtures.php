<?php

namespace App\DataFixtures;

use App\Entity\RP;
use Faker\Factory;
use App\Entity\Professeur;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProfesseurFixtures extends Fixture
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

        $prof= new Professeur();
        $prof->setNomComplet($faker->firstName()." ".$faker->lastName());
        $prof->setGrade("Technicien");
        $prof->setRP($rp);
        $prof->setRole('ROLE_PROFESSEUR');
        $manager->persist($prof);

        $manager->flush();
    }
}
