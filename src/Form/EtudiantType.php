<?php

namespace App\Form;

use App\Entity\Etudiant;
use App\Repository\ACRepository;
use App\Repository\ClasseRepository;
use Symfony\Component\Form\AbstractType;
use App\Repository\AnneeScolaireRepository;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EtudiantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options/* ,ClasseRepository $classe_repo, ACRepository $ac_repo,AnneeScolaireRepository $anscolaire_repo */): void
    {
        /* $classes = $classe_repo->findAll();
        $acs = $ac_repo->findAll();
        $annees = $anscolaire_repo->findAll(); */

        $builder
            ->add('nomComplet')
            ->add('role')
            ->add('login')
            ->add('password')
            ->add('matricule')
            ->add('adresse')
            ->add('sexe', ChoiceType::class, [
                'choices' => [
                    '--Veuillez choisir votre sexe--' => [
                        'Masculin' => 'masculin',
                        'Feminin' => 'feminin',
                    ],
                ],
                ])
            ->add('Ajouter',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Etudiant::class,
        ]);
    }
}
