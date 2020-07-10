<?php

namespace App\DataFixtures;

use App\Entity\Equipment;
use App\Entity\Project;
use App\Entity\Task;
use App\Entity\User;
use App\Entity\Worker;
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
            // Ajouter 10 taches
            for ($j = 0; $j < 10; $j++) {
                $task = new Task();
                $task->setName($faker->realText($maxNbChars = 100));
                $task->setStartDate($faker->dateTime());
                $task->setEndDate($faker->dateTime());
                $task->setProject($project);
                // Ajouter 10 ouvriers
                for ($n = 0; $n < 10; $n++) {
                    $worker = new Worker();
                    $worker->setFullName($faker->name);
                    $worker->setSpecialty($faker->word);
                    $worker->setTask($task);
                    $manager->persist($worker);
                }
                // Ajouter 10 matriels
                for ($m = 0; $m < 10; $m++) {
                    $equipment = new Equipment();
                    $equipment->setName($faker->city);
                    $equipment->setQuantity($faker->randomDigitNotNull);
                    $equipment->setTask($task);
                    $manager->persist($equipment);
                }
                $manager->persist($task);
            }
            $manager->persist($project);
        }

        // Mise à jour dans le base de données
        $manager->flush();
    }

}
