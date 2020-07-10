<?php

namespace App\DataFixtures;

use App\Entity\Project;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture {

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder) {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager) {
        $faker = Factory::create('fr_FR');
        // Ajouter utilisateur
        $user = new User();
        $user->setEmail('user@user.com');
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'password'));
        $user->setRoles(array('ROLE_USER'));
        $manager->persist($user);
        // Ajouter administrateur
        $admin = new User();
        $admin->setEmail('admin@admin.com');
        $admin->setPassword($this->passwordEncoder->encodePassword($admin, 'password'));
        $admin->setRoles(array('ROLE_ADMIN'));
        $manager->persist($admin);
        // Ajouter 50 projets
        for ($i = 0; $i < 50; $i++) {
            $project = new Project();
            $project->setName($faker->catchPhrase);
            $project->setStartDate($faker->dateTime());
            $project->setEndDate($faker->dateTime());
            $project->setDescription($faker->realText($maxNbChars = 200));
            $project->setLocation($faker->address);
            $manager->persist($project);
        }

        // Mise à jour dans le base de données
        $manager->flush();
    }

}
