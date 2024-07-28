<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactFormType extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options)
{
$builder
->add('email', EmailType::class, [
'label' => 'Votre email',
])
->add('subject', TextType::class, [
'label' => 'Sujet',
])
->add('message', TextareaType::class, [
'label' => 'Message',
]);
}

public function configureOptions(OptionsResolver $resolver)
{
$resolver->setDefaults([
]);
}
}
