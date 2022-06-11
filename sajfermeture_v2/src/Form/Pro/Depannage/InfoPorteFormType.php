<?php

namespace App\Form\Pro\Depannage;

use App\Entity\Depannage\InfoPorte;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InfoPorteFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('hauteur', IntegerType::class, [
                "label"      => "Hauteur (arrondie à l'unité)",
                "label_attr" => [
                    "class" => "text-muted"
                ],
                "attr" => [
                    "placeholder" => "Hauteur en millimètre"
                ]
            ])
            ->add('largeur', IntegerType::class, [
                "label"      => "Largeur (arrondie à l'unité)",
                "label_attr" => [
                    "class" => "text-muted"
                ],
                "attr" => [
                    "placeholder" => "Largeur en millimètre"
                ]
            ])
            ->add('isEcoinCon', CheckboxType::class, [
                "label"      => "Écoinçon",
                "label_attr" => [
                    "class" => "text-muted"
                ]
            ])
            ->add('isPassageLibre', CheckboxType::class, [
                "label"      => "Passage libre",
                "label_attr" => [
                    "class" => "text-muted"
                ]
            ])
            ->add('isRetombe', CheckboxType::class, [
                "label"      => "Retombée de linteau",
                "label_attr" => [
                    "class" => "text-muted"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => InfoPorte::class,
        ]);
    }
}
