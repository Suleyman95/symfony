<?php
/**
 * Created by PhpStorm.
 * User: msv
 * Date: 04.05.18
 * Time: 20:01
 */

namespace App\Command;

use App\Entity\NamespaceSymfony;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DomCrawler\Crawler;

class CreateUserCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('parse:symfony')

            // the short description shown while running "php bin/console list"
            ->setDescription('Creates a new user.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command allows you to create a user...')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $url = "https://api.symfony.com/4.0/";
        $html = file_get_contents($url);
        $crawler = new Crawler($html);

        $crawler = $crawler->filter('.namespace-container > ul > li > a');


        $em = $this->getContainer()->get('doctrine.orm.default_entity_manager');

        foreach ($crawler as $element) {
            $namespace = new NamespaceSymfony();

            $namespace->setName($element->textContent);
            $namespace->setUrl($url . $element->getAttribute('href'));
            //var_dump($namespace);

            $em->persist($namespace);
        }

        $em->flush();
    }
}