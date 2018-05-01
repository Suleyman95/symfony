<?php
/**
 * Created by PhpStorm.
 * User: msv
 * Date: 01.05.18
 * Time: 17:32
 */

namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ArticleControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testCreate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/create');

        $form = $crawler->selectButton('article[save]')->form();

        // set some values
        $form['article[name]'] = 'Lucas';
        $form['article[description]'] = 'Hey there!';
        $form['article[createdAt][date][year]']->select(2018);
        $form['article[createdAt][date][month]']->select(5);
        $form['article[createdAt][date][day]']->select(23);



        // submit the form
        $crawler = $client->submit($form);

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }

    public function testDelete()
    {
        $client = static::createClient();

        $client->request('GET', '/delete/6');

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }
}