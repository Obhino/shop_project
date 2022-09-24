<?php

namespace App\Form;

use App\Entity\Boutique;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\Length;

class AddShopFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextareaType::class,[
                'constraints'=>[new Length(5)]
            ])
            ->add('domaine', TextareaType::class)
            //->add('type_abonnement')
            //->add('vendeur_max')
            ->add('isInternational',ChoiceType::class,[
                'mapped'=>false,
            ])
            ->add('pays',CountryType::class)
            ->add('ville',TextareaType::class)
            ->add('logo', FileType::class, [
                'mapped'=>false,
                'multiple'=>false,
                'constraints'=>[ new Image(['maxSize'=>'3072K'])]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Boutique::class,
        ]);
    }
}
