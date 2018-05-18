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
        $client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'Admin',
            'PHP_AUTH_PW'   => '12345',
        ));

        $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode(), $client->getResponse()->getContent());
    }

    public function testCreate()
    {
        $client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'Admin',
            'PHP_AUTH_PW'   => '12345',
        ));

        $crawler = $client->request('GET', '/create');

        $form = $crawler->selectButton('article[save]')->form();

        // set some values
        $form['article[name]'] = 'Lucas';
        $form['article[description]'] = 'Hey there!';
        $form['article[createdAt][date][year]']->select(2018);
        $form['article[createdAt][date][month]']->select(5);
        $form['article[createdAt][date][day]']->select(23);
        $form['article[createdAt][time][hour]']->select(23);
        $form['article[createdAt][time][minute]']->select(59);

        // submit the form
        $client->submit($form);

        $this->assertEquals(302, $client->getResponse()->getStatusCode(), $client->getResponse()->getContent());
    }

    public function testEdit()
    {
        $client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'Admin',
            'PHP_AUTH_PW'   => '12345',
        ));

        $crawler = $client->request('GET', '/edit/8');

        $form = $crawler->selectButton('article[save]')->form();

        // set some values
        $form['article[name]'] = 'Lucasandro';
        $form['article[description]'] = 'Hey there!';
        $form['article[createdAt][date][year]']->select(2018);
        $form['article[createdAt][date][month]']->select(5);
        $form['article[createdAt][date][day]']->select(23);
        $form['article[createdAt][time][hour]']->select(23);
        $form['article[createdAt][time][minute]']->select(59);

        // submit the form
        $client->submit($form);

        $this->assertEquals(302, $client->getResponse()->getStatusCode(), $client->getResponse()->getContent());
    }


    public function testDelete()
    {
        $client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'Admin',
            'PHP_AUTH_PW'   => '12345',
        ));

        $client->request('GET', '/delete/6');

        $this->assertEquals(302, $client->getResponse()->getStatusCode(), $client->getResponse()->getContent());
    }
}