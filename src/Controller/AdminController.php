<?php

namespace App\Controller;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminController extends EasyAdminController {

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder) {
        $this->passwordEncoder = $passwordEncoder;
    }

    protected function persistUserEntity($user) {
        $user->setPassword($this->passwordEncoder->encodePassword($user, $user->getPassword()));
        parent::persistEntity($user);
    }

    protected function updateUserEntity($user) {
        $user->setPassword($this->passwordEncoder->encodePassword($user, $user->getPassword()));

        parent::updateEntity($user);
    }

}
