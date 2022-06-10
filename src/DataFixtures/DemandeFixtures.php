<?php

namespace App\DataFixtures;


use DateTime;
use App\Entity\RP;
use Faker\Factory;
use DateTimeInterface;
use App\Entity\Demande;
use App\Entity\Etudiant;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class DemandeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker= Factory::create("fr_Fr");

        $rp =new RP();
        $rp->setNomComplet('Mamadou Ndiaye');
        $rp->setLogin('momodoundiaye@gmail.com');
        $rp->setPassword('passer');
        $rp->setRole('ROLE_RP');
        $manager->persist($rp);

        $etu = new Etudiant();
        $etu->setNomComplet($faker->firstName()." ".$faker->lastName());
        $etu->setLogin($faker->email());
        $etu->setPassword($faker->password());
        $etu->setMatricule("MAT001");
        $etu->setAdresse($faker->streetName());
        $etu->setSexe("Masculin");
        $etu->setRole('ROLE_ETUDIANT');
        $manager->persist($etu);

        $demande = new Demande();
        $dateArrondie = new DateTime(date('Y-m-d H:00:00'));
        $time = strtotime('10/16/2003');
        $newformat = date('Y-m-d',$time);
        $demande->setEtudiant($etu);
        $demande->setRp($rp);
        $demande->setLibelleDemande($faker->company());
        $demande->setDate($dateArrondie);
        $manager->persist($demande);

        $manager->flush();
    }
}
