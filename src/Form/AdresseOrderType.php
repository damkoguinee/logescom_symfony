<?php

namespace App\Form;

use App\Entity\Adresse;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdresseOrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $user = $options['user'];
        $builder
            ->add('id', EntityType::class, [
                'class' => Adresse::class,
                'label' =>false,
                'required' => true,
                'multiple' => false,
                'choices'   => $user->getAdresses(),
                'expanded' => true,
                'choice_value' => 'id',
                'choice_label' => 'rue',
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'user' => [],
        ]);
    }
}
