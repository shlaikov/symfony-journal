<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Создать статью', $crawler->filter('nav a')->text());
    }

    public function testArticle()
    {
        $client = static::createClient();

        $client->request('GET', '/post/example');
        $this->assertEquals(500, $client->getResponse()->getStatusCode());

        $crawler = $client->request('GET', '/post/samj-nulevoj-zagolovok');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Назад', $crawler->filter('nav a')->text());
    }
}
