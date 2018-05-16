<?php
/**
 * Created by PhpStorm.
 * User: msv
 * Date: 16.05.18
 * Time: 22:34
 */

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
        $set_user->setPassword('12345');

        $manager->persist($set_user);

        $manager->flush();
    }
}