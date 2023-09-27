<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Partenaire;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        dump($options);
        $builder
            ->add('email', EmailType::class, [])
            ->add('adresse', TextareaType::class, [])
            ->add('code_postal', NumberType::class, [])
            ->add('ville', TextType::class, [])
            ->add('telephone', TelType::class, []);

        if ($options["TYPE"] === Client::class) {
            $builder->add('client', ClientType::class, [

            ]);
        }

        if ($options["TYPE"] === Partenaire::class) {
            $builder->add('partenaire', PartenaireType::class, [
                'label' => false
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'TYPE' => Client::class,
            'data_class' => User::class,
        ]);
    }
}
