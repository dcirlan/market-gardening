<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    
    public function load(ObjectManager $manager)
    {
        // Création d’un utilisateur de type “contributeur” (= auteur)

        $contributor = new User();

        $contributor->setEmail('contributor@monsite.com');

        $contributor->setFirstname('max');

        $contributor->setSecondname('maxim');

        $contributor->setRoles(['ROLE_CONTRIBUTOR']);

        $contributor->setPassword($this->passwordEncoder->encodePassword(

            $contributor,

            'contributor'

        ));


        $manager->persist($contributor);


        // Création d’un utilisateur de type “administrateur”

        $admin = new User();

        $admin->setEmail('admin@monsite.com');

        $admin->setFirstname('den');

        $admin->setSecondname('denis');

        $admin->setRoles(['ROLE_ADMIN']);

        $admin->setPassword($this->passwordEncoder->encodePassword(

            $admin,

            'admin'

        ));


        $manager->persist($admin);


        // Sauvegarde des 2 nouveaux utilisateurs :

        $manager->flush();    
    }
}
