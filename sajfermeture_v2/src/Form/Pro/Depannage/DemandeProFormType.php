<?php

namespace App\Form\Pro\Depannage;

use App\Entity\Depannage\DemandePro;
use App\Entity\Depannage\TypeDepannage;
use App\Entity\Depannage\TypePorte;
use App\Repository\Depannage\TypeDepannageRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Image;

class DemandeProFormType extends AbstractType
{

    public function __construct(
        private TypeDepannageRepository $typeDepannageRepository
    )
    {
        $this->typeDepannageRepository = $typeDepannageRepository;

        $this->customTypeDepannageChoiceType = [];

        foreach ($this->typeDepannageRepository->findAll() as $typeDepannage) {
            if($typeDepannage->getValue() != "porte" && $typeDepannage->getValue() != "all"){
                $this->customTypeDepannageChoiceType[$typeDepannage->getLibelle()] = $typeDepannage->getValue();
            }
        }
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description', TextareaType::class, [
                "label"      => "Description",
                "label_attr" => [
                    "class" => "text-muted"
                ],
                "attr" => [
                    "placeholder" => "Décrivez votre demande..."
                ]
            ])
            ->add('typeDepannage', ChoiceType::class, [
                "label"        => "Type de dépannage",
                "placeholder"  => "Choisir le type de dépannage",
                'choices'  => $this->customTypeDepannageChoiceType,
                "label_attr"   => [
                    "class" => "text-muted"
                ],
                "mapped" => false
            ])
            ->add('typePorte', EntityType::class, [
                "label"        => "Type de porte",
                "class"        => TypePorte::class,
                "choice_label" => "libelle",
                "label_attr"   => [
                    "class" => "text-muted typePorteClass",
                    "style" => "display: none;"
                ],
                "attr" => [
                    "style" => "display: none;"
                ]
            ])
            ->add('infoPorte', InfoPorteFormType::class, [
                "label"      => "Caractéristique de la porte",
                "label_attr" => [
                    "class" => "text-muted infoPorteClass",
                    "style" => "display: none;"
                ],
                "attr" => [
                    "style"    => "display: none;",
                    
                ],
            ])
            ->add('typeMoteur', TypeMoteurFormType::class, [
                "label"      => "Type de moteur",
                "label_attr" => [
                    "class" => "text-muted typeMoteurClass",
                    "style" => "display: none;"
                ],
                "attr" => [
                    "style" => "display: none;"
                ]
            ])
            ->add('description', TextareaType::class, [
                "label"      => "Description",
                "label_attr" => [
                    "class" => "text-muted"
                ],
                "attr" => [
                    "placeholder" => "Décrivez votre demande..."
                ]
            ])
            ->add("images", FileType::class, [
                "mapped"   => false,
                "multiple" => true,
                "attr"    =>[
                    "placeholder" =>" ,"
                ]
                // 'constraints' => [
                //     new File([
                //         'mimeTypes' => [
                //             'image/png',
                //             'image/jpeg',
                //         ],
                //         'mimeTypesMessage' => 'Images autorisées: JPG, JPEG, PNG',
                //     ])
                // ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DemandePro::class,
        ]);
    }
}
