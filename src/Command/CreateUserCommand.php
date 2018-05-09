<?php
/**
 * Created by PhpStorm.
 * User: msv
 * Date: 04.05.18
 * Time: 20:01
 */

namespace App\Command;

use App\Entity\ClassSymfony;
use App\Entity\InterfaceSymfony;
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
        $em = $this->getContainer()->get('doctrine.orm.default_entity_manager');

        $url = "https://api.symfony.com/4.0/";
        $html = file_get_contents($url);
        $crawler = new Crawler($html);

        $crawler = $crawler->filter('.namespace-container > ul > li > a');

        foreach ($crawler as $element) {

            $namespace = new NamespaceSymfony();
            //$namespace->setParent(null);
            $namespace->setName($element->textContent);
            $namespace_url = $namespace->setUrl($url . $element->getAttribute('href'));

            $em->persist($namespace);

            $namespaceHtml = file_get_contents($namespace_url->getUrl());
            $crawlerClass = new Crawler($namespaceHtml);

            $classlinks = $crawlerClass->filter('.container-fluid.underlined > .row > .col-md-6 > a');

            foreach ($classlinks as $classes) {
                $class = new ClassSymfony();
                $urls = ($url . str_replace('../', '', $classes->getAttribute('href')));
                $class->setName($classes->textContent);
                $class->setUrl($urls);
                $class->setNamespace($namespace);

                $em->persist($class);
            }

            $interfacelinks = $crawlerClass->filter('.container-fluid.underlined > .row > .col-md-6 > em > a');

            foreach ($interfacelinks as $interfaces) {
                $interface = new InterfaceSymfony();
                $urls = ($url . str_replace('../', '', $interfaces->getAttribute('href')));
                $interface->setName($interfaces->textContent);
                $interface->setUrl($urls);
                $interface->setNamespace($namespace);

                $em->persist($interface);
            }
        }

        $em->flush();
    }
}