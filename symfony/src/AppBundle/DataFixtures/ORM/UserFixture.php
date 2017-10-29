<?php

namespace Evolaze\Paiod\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Evolaze\Paiod\AppBundle\Entity\Uzer;

class UserFixture implements FixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        foreach (['foo', 'bar'] as $value) {
            $user = new Uzer();
            $user->setUsername($value);
            $user->setToken($value);
            $manager->persist($user);
        }
        $manager->flush();
    }
}