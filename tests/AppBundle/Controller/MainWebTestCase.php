<?php

namespace Tests\AppBundle\Controller;

use AppBundle\Entity\Restaurant;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MainWebTestCase extends WebTestCase
{
    private $createdObjects = [];
    private $em;

    public function createRestaurantUser()
    {
        $this->em = $this::$kernel->getContainer()->get('doctrine.orm.entity_manager');
        $restaurant = new Restaurant();
        $restaurant->setName('test_name');
        $restaurant->setEmail('test@test.com');
        $restaurant->setPhone('123123123');
        $restaurant->setToken('2222222222');
        $restaurant->setUsername('username_test');
        $restaurant->setPassword('password_test');

        $this->em->persist($restaurant);
        $this->createdObjects[] = $restaurant;
        $this->em->flush();
    }

    /**
     * This is to remove all the inserted objects in the DB
     */
    public function destroyObjects()
    {
        foreach ($this->createdObjects as $object) {
            $this->em->remove($object);
        }
        $this->em->flush();
    }
}
