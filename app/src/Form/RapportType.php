<?php

namespace App\Form;

use App\Entity\Intervention;
use App\Entity\InterventionUser;
use App\Entity\Rapport;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RapportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description',TextareaType::class)
            ->add('intervention', EntityType::class, [
                'class' => Intervention::class,
                'choice_label'=>'id',
                'label'=>'numero d\'intervention'
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label'=>'email',
                'label'=>'utilisateur'
            ])
            ->add('ajouter', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Rapport::class,
        ]);
    }
}
