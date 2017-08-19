<?php namespace Tests\AppBundle\Controller\Api;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LoginControllerTest extends WebTestCase
{
    public function testLoginAction()
    {
        $client = self::createClient();

        $crawler = $client->request('POST', 'api/fs/authenticate');

        $data = (array) json_decode($client->getResponse()->getContent());
        $this->assertArrayHasKey('message', $data);
    }
}