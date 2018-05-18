<?php


namespace App\DataFixtures;


use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // TODO: Implement load() method.
        $set_user = new User();

        $set_user->setUsername('Admin');
        $set_user->setPassword(password_hash('12345', PASSWORD_DEFAULT));

        $manager->persist($set_user);

        $manager->flush();
    }
}