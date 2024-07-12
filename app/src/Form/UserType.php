<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Adress;
use App\Entity\Extincteur;
use App\Entity\Intervention;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('roles', ChoiceType::class, [
                'multiple' => true,
                'choices'=>[
                    'admin'=>'ROLE_ADMIN',
                    'user'=>'ROLE_USER',
                    'tech'=>'ROLE_TECH']
                ])
            ->add('prenom')
            ->add('nom')
            ->add('isActive')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
