<?php namespace Tests\AppBundle\Controller\Api;


use Tests\AppBundle\Controller\MainWebTestCase;

class LoginControllerTest extends MainWebTestCase
{
    public function testLoginActionWithWrongCredentials()
    {
        $client = self::createClient();

        $crawler = $client->request('POST', 'api/fs/authenticate', [
            '_username' => 'username_test',
            '_password' => 'password_test',
        ], [], ['content_type' => 'application/json']);

        $data = (array) json_decode($client->getResponse()->getContent());
        $this->assertArrayHasKey('message', $data);
    }

    public function testLoginActionWithExistingCredentials()
    {
        $client = self::createClient();

        $this->createRestaurantUser();

        $crawler = $client->request('POST', 'api/fs/authenticate', [
            '_username' => 'username_test',
            '_password' => 'password_test',
        ], [], ['content_type' => 'application/json']);

        $data = (array) json_decode($client->getResponse()->getContent());
        $this->assertArrayHasKey('_token', $data);
        $this->destroyObjects();
    }
}