<?php

namespace App\Form;

use App\Entity\Extincteur;
use App\Entity\Intervention;
use App\Entity\Status;
use App\Entity\TypeIntervention;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InterventionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateCreation', null, [
                'widget' => 'single_text',
            ])
            ->add('dateIntervention', null, [
                'widget' => 'single_text',
            ])
            ->add('isUrgent',CheckboxType::class,[
                'required' => false,
                'data'=>false,
            ])
            ->add('userId', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'email',
                'multiple' => true,
            ])
            ->add('typeInterventionId', EntityType::class, [
                'class' => TypeIntervention::class,
                'choice_label' => 'label',
            ])
            ->add('extincteurs', EntityType::class, [
                'class' => Extincteur::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Intervention::class,
        ]);
    }
}
