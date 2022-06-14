<?php

namespace App\DataFixtures;

use App\Entity\RP;
use Faker\Factory;
use Faker\Generator;
use App\Entity\AC;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AcFixtures extends Fixture
{
    private Generator $faker;

    public function __construct(){
        $this->faker= Factory::create("fr_Fr");
    }

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

            $ac = new AC();
            $ac->setNomComplet($faker->firstName()." ".$faker->lastName());
            $ac->setEmail($faker->email());
            $ac->setPassword($faker->password());
            $ac->setRole('ROLE_AC');
            $manager->persist($ac);
        }

        $manager->flush();
    }
}
