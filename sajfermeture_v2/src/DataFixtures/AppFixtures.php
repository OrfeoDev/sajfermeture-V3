<?php

namespace App\DataFixtures;

use App\Entity\Authentication\User;
use App\Entity\Authentication\UserRole;
use App\Entity\Depannage\TypeMoteur;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Client\Pro\Professionnel;
use App\Entity\Depannage\TypeDepannage;
use App\Entity\Depannage\TypePorte;
use App\Entity\General\DemandeStatut;
use App\Entity\Setting\AppInformation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        // Insertion des informations clés de l'application
        $appInformation = new AppInformation;
        $appInformation->setTokenCreateComptePro("token_pro_5555");

        // Création du rôle pour la connexion au backoffice
        $userRoleBackOffice = new UserRole;
        $userRoleBackOffice->setLibelle("ROLE_BACKOFFICE");

        // Création de l'utilisateur lié au backoffice
        $userBackOffice = new User;
        $userBackOffice->setEmail("sajfermeture@live.fr")
                       ->setPassword($this->hasher->hashPassword($userBackOffice, "password"));

        $userBackOffice->addUserRole($userRoleBackOffice);

        // Création de l'utilisateur lié au compte pro
        $userPro = new User;
        $userPro->setEmail("pro@pro.fr")
                ->setPassword($this->hasher->hashPassword($userPro, "password"));

        // Création d'un professionnel
        $pro = new Professionnel;
        $pro->setAddress("25 rue mon adresse")
            ->setCity("Cournonsec")
            ->setCountry("FR")
            ->setEmail("pro@pro.fr")
            ->setFirstName("John")
            ->setLastName("Doe")
            ->setPhone("06060606")
            ->setPostalCode("34660")
            ->setSiret("FOEFE555FE5FE")
            ->setSocialReason("PRODULOGIS")
            ->setUser($userPro);

        $userPro->setProfessionnel($pro);

        // Création des données métiers
        // 1 : Création des différents types de dépannage
        $typesDepannageArray = [
            [
                "libelle" => "Porte",
                "value"   => "porte"
            ],
            [
                "libelle" => "Moteur",
                "value"   => "moteur"
            ],
            [
                "libelle" => "Les deux",
                "value"   => "all"
            ]
        ];

        foreach ($typesDepannageArray as $typeDepannageParsed) {
            $typeDepannage = new TypeDepannage;
            $typeDepannage->setLibelle($typeDepannageParsed["libelle"])
                          ->setValue($typeDepannageParsed["value"]);
            $manager->persist($typeDepannage);
        }

        // 2 : Création des différents types de porte
        $typesPorteArray = [
            "Sectionnelle",
            "Porte souple",
            "Portail exterieur",
            "Rideau métallique",
            "Coupe feu"
        ];

        foreach ($typesPorteArray as $typePorteParsed) {
            $typePorte = new TypePorte;
            $typePorte->setLibelle($typePorteParsed);
            $manager->persist($typePorte);
        }

        // 4 : Création des différents types de porte
        $typesMoteurArray = [
            "Manuel",
            "Motorisé pression maintenue",
            "Motorisé impulsion",
        ];

        foreach ($typesMoteurArray as $typeMoteurParsed) {
            $typeMoteur = new TypeMoteur();
            $typeMoteur->setTypeFonctionnement($typeMoteurParsed);
            $manager->persist($typeMoteur);
        }



        // 5 : Création des status liés aux demandes
        $statusDemandes = [
            [
                "libelle" => "Non traité",
                "value"   => "todo"
            ],
            [
                "libelle" => "Traité",
                "value"   => "done"
            ]


        ];

        foreach($statusDemandes as $arrayStatut){
            $demandeStatut = new DemandeStatut;
            $demandeStatut->setLibelle($arrayStatut["libelle"])
                          ->setValue($arrayStatut["value"]);
            $manager->persist($demandeStatut);
        }

        $manager->persist($userRoleBackOffice);
        $manager->persist($userBackOffice);
        $manager->persist($appInformation);
        $manager->persist($userPro);
        $manager->persist($pro);

        $manager->flush();
    }
}
