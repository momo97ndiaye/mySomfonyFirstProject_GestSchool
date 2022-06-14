<?php

namespace App\DataFixtures;

use App\Entity\AC;
use App\Entity\RP;
use Faker\Factory;
use App\Entity\Classe;
use App\Entity\Etudiant;
use App\Entity\Inscription;
use App\Entity\AnneeScolaire;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class InscriptionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
{           $faker= Factory::create("fr_Fr");

            $rp =new RP();
            $rp->setNomComplet('Mamadou Ndiaye');
            $rp->setEmail($faker->email());
            $rp->setPassword('passer');
            $rp->setRole('ROLE_RP');
            $manager->persist($rp);
            
            $ac = new AC();
            $ac->setNomComplet($faker->firstName()." ".$faker->lastName());
            $ac->setEmail($faker->email());
            $ac->setPassword($faker->password());
            $ac->setRole('ROLE_AC');
            $manager->persist($ac);

            $classe = new Classe();
            $classe->SetRp($rp);
            $classe->SetNiveau("Licence1");
            $classe->SetLibelle("STIC");
            $classe->SetFiliere("Informatique");
            $manager->persist($classe);

            $etu = new Etudiant();
            $etu->setNomComplet($faker->firstName()." ".$faker->lastName());
            $etu->setEmail($faker->email());
            $etu->setPassword($faker->password());
            $etu->setMatricule("MAT001");
            $etu->setAdresse("Sicap Foire");
            $etu->setSexe("Masculin");
            $etu->setRole('ROLE_ETUDIANT');
            $manager->persist($etu);

            $an = new AnneeScolaire();
            $an->setLibelle("2021/2022");
            $manager->persist($an);

            $ins = new Inscription();
            $ins->setAc($ac);
            $ins->setEtudiant($etu);
            $ins->setClasse($classe);
            $ins->setAnneescolaire($an);
            $manager->persist($ins);


        $manager->flush();
    }
}
