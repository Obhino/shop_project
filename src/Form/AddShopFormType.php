<?php

namespace App\Form;

use App\Entity\Boutique;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddShopFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('logo')
            ->add('domaine')
            ->add('type_abonnement')
            ->add('vendeur_max')
            ->add('isInternational')
            ->add('pays')
            ->add('ville')
            ->add('createdAt')
            ->add('statut')
            ->add('proprietaire_id')
            ->add('proprietaire')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Boutique::class,
        ]);
    }
}
