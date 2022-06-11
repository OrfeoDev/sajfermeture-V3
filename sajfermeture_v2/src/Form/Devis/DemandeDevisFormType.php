<?php

namespace App\Form\Devis;

use App\Entity\Depannage\TypeMoteur;
use App\Entity\Devis\DemandeDevis;
use App\Entity\Depannage\TypePorte;
use Symfony\Component\Form\AbstractType;
use App\Form\Pro\Depannage\InfoPorteFormType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class DemandeDevisFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('infoPorte', InfoPorteFormType::class, [
                "label"      => "Caractéristique de la porte",
                "label_attr" => [
                    "class" => "text-muted infoPorteClass",
                ]
            ])
            ->add('typePorte', EntityType::class, [
                "label"        => "Type de porte",
                "class"        => TypePorte::class,
                "choice_label" => "libelle",
                "label_attr"   => [
                    "class" => "text-muted typePorteClass",
                ]
            ])
            ->add('TypeMoteur',EntityType::class,[
                    "label"        => "Type de moteur souhaité",
                    "class"        => TypeMoteur::class,
                    "choice_label" => "typeFonctionnement",
                    "label_attr"   => [
                        "class" => "text-muted typeMoteurClass",
                    ]
                ]
            )
            ->add('description', TextareaType::class, [
                "label"      => "Description",
                "label_attr" => [
                    "class" => "text-muted"
                ],
                "attr" => [
                    "placeholder" => "Décrivez votre demande de devis..."
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DemandeDevis::class,
        ]);
    }
}
