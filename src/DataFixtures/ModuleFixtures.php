<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Module;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ModuleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker= Factory::create("fr_Fr");

        for ($i=1; $i < 4; $i++) { 

            $module = new Module();
            $module->setLibelle("Algo".$i);
            $manager->persist($module);
        }

        


        $manager->flush();
    }
}
