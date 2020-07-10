<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name', TextType::class, [
                    'label' => false,
                    'attr' => ['placeholder' => 'Nom'],
                ])
                ->add('message', TextareaType::class, [
                    'label' => false,
                    'attr' => ['placeholder' => 'Message'],
                ])
                ->add('object', TextType::class, [
                    'label' => false,
                    'attr' => ['placeholder' => 'Objet'],
                ])
                ->add('email', EmailType::class, [
                    'label' => false,
                    'attr' => ['placeholder' => 'Adresse de messagerie'],
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }

}
