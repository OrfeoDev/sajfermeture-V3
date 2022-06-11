<?php

namespace App\Form\Pro\Depannage;

use App\Entity\Depannage\TypeMoteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TypeMoteurFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numeroMoteur', TextType::class, [
                "label"      => "N° de moteur",
                "label_attr" => [
                    "class" => "text-muted"
                ],
                "attr" => [
                    "placeholder" => "Renseignez le numéro de moteur",
                    "required"    => false
                ]
            ])
            ->add('voltage', ChoiceType::class, [
                "label"      => "Voltage",
                "label_attr" => [
                    "class" => "text-muted"
                ],
                "placeholder" => "Choisir le voltage",
                'choices'  => [
                    '230v' => "230v",
                    '400v' => "400v",
                ],
                "attr" => [
                    "required" => false
                ]
            ])
            ->add('typeFonctionnement', ChoiceType::class, [
                "label"      => "Type de fonctionnement",
                "label_attr" => [
                    "class" => "text-muted"
                ],
                "placeholder" => "Choisir le type de fonctionnement",
                'choices'  => [
                    'Manuel' => "Manuel",
                    'Motorisé pression maintenue' => "Motorisé pression maintenue",
                    'Motorisé impulsion' => "Motorisé impulsion"
                ],
                "attr" => [
                    "required" => false
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TypeMoteur::class,
        ]);
    }
}
