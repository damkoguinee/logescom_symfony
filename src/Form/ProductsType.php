<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Dimensions;
use App\Entity\Epaisseurs;
use App\Entity\OrigineProduit;
use App\Entity\Products;
use App\Entity\TypeProduit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ProductsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reference', null, [
                "label"             =>"Référence*",
                "constraints"       =>[
                    new Length([
                        "max"           => 100,
                        "maxMessage"    =>"la référence ne peut depassé 100"
                    ]),
                    new NotBlank(["message" => "La référence ne peut pas être vide"])
                ]
            ])
            ->add('designation', null, [
                "label"             =>"Désignation*",
                "constraints"       =>[
                    new Length([
                        "max"           => 100,
                        "maxMessage"    =>"la désignation ne peut depassé 100"
                    ]),
                    new NotBlank(["message" => "La désignation ne peut pas être vide"])
                ]
            ])
            ->add('categorie', EntityType::class, [
                "class"             =>Categorie::class,
                "choice_label"      =>"nameCategorie",
                "placeholder"       =>"Selectionner une catégorie"
            ])
            ->add('epaisseur', EntityType::class, [
                "class"             =>Epaisseurs::class,
                "required" => false,
                "choice_label"      =>"valeurEpaisseur",
                "placeholder"       =>"Selectionner un épaisseur"
            ])
            ->add('dimension', EntityType::class, [
                "class"             =>Dimensions::class,
                "choice_label"  =>  function(Dimensions $a){
                    return $a->getValeurDimension()." ".$a->getCategorie()->getNameCategorie();
                },
                // "choice_label"      =>"valeurDimension",
                "placeholder"       =>"Selectionner une dimension"
            ])

            ->add('origine', EntityType::class, [
                "class"             =>OrigineProduit::class,
                "choice_label"  =>  function(OrigineProduit $a){
                    return $a->getPays();
                },
                // "choice_label"      =>"valeurDimension",
                "placeholder"       =>"Origine Produit"
            ])

            ->add('type', EntityType::class, [
                "class"             =>TypeProduit::class,
                "choice_label"  =>  function(TypeProduit $a){
                    return $a->getDesignation();
                },
                // "choice_label"      =>"valeurDimension",
                "placeholder"       =>"Type Produit"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Products::class,
        ]);
    }
}
