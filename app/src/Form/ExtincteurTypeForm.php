<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Extincteur;
use App\Entity\ExtincteurType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ExtincteurTypeForm extends AbstractType implements FormTypeInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('dateMaintenance', DateType::class, [
            'widget' => 'single_text',
            'label' => 'Date de maintenance'
        ])
        ->add('dateFabrication', DateType::class, [
            'widget' => 'single_text',
            'label' => 'Date de fabrication'
        ])
        ->add('quantity', NumberType::class, [
            'label' => 'Quantité'
        ])
        ->add('Ajouter', SubmitType::class)

        ->add('userId',EntityType::class,[
            'class'=>User::class,
            'choice_label'=>'email',
            'label'=>'Utilisateur',
            'multiple'=>true
        ])
        ->add('extincteurTypeId',EntityType::class,[
            'class'=>ExtincteurType::class,
            'choice_label'=>'label',
            'label'=>'type d\'extincteur'
        ])
    ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Extincteur::class,
        ]);
    }
}
