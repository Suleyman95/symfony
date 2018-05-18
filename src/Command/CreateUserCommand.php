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
        /*$em = $this->getContainer()->get('doctrine.orm.default_entity_manager');

        $url = "https://api.symfony.com/4.0/";
        $html = file_get_contents($url);
        $crawler = new Crawler($html);

        $crawler = $crawler->filter('.namespace-container > ul > li > a');

        foreach ($crawler as $element) {

            var_dump($element->textContent);
            $namespace = new NamespaceSymfony();
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

        $em->flush();*/

        /****************************************************************************************/

        $em = $this->getContainer()->get('doctrine.orm.default_entity_manager');

        $namespace = new NamespaceSymfony();
        $namespace->setName('Symfony');
        $namespace->setUrl('http://api.symfony.com/4.0/Symfony.html');
        $namespace->setParent(null);

        $em->persist($namespace);

        $this->recursion('http://api.symfony.com/4.0/Symfony.html', $namespace);
    }

    public function recursion(string $url, NamespaceSymfony $parent)
    {
        $em = $this->getContainer()->get('doctrine.orm.default_entity_manager');

        $html = file_get_contents($url);
        $crawler = new Crawler($html);
        $crawler = $crawler->filter('.namespace-list > a');
        $baseUrl = 'http://api.symfony.com/4.0/';

        foreach ($crawler as $namespaces) {

            $url = $baseUrl . str_replace('../', '', $namespaces->getAttribute('href'));

            var_dump('NAMESPASE');
            var_dump($namespaces->textContent);
            var_dump($url);
            $namespace = new NamespaceSymfony();
            $namespace->setName($namespaces->textContent);
            $namespace->setUrl($url);
            $namespace->setParent($parent);

            $em->persist($namespace);

            $html = file_get_contents($url);
            $crawler = new Crawler($html);
            $crawlerClass = $crawler->filter('.container-fluid.underlined > .row > .col-md-6 > a');

            foreach ($crawlerClass as $classes) {

                $urlClass = $baseUrl . str_replace('../', '', $classes->getAttribute('href'));

                var_dump('CLASS');
                var_dump($classes->textContent);
                var_dump($urlClass);
                $class = new ClassSymfony();
                $class->setName($classes->textContent);
                $class->setUrl($urlClass);
                $class->setNamespace($namespace);

                $em->persist($class);
            }

            $crawlerInterface = $crawler->filter('.container-fluid.underlined > .row > .col-md-6 > em > a');

            foreach ($crawlerInterface as $interfaces) {

                $urlInterface = ($baseUrl . str_replace('../', '', $interfaces->getAttribute('href')));

                var_dump('INTERFACE');
                var_dump($interfaces->textContent);
                var_dump($urlInterface);
                $interface = new InterfaceSymfony();
                $interface->setName($interfaces->textContent);
                $interface->setUrl($urlInterface);
                $interface->setNamespace($namespace);

                $em->persist($interface);
            }

            $this->recursion($url, $namespace);
            //$em->flush();
        }

        if ($url == 'http://api.symfony.com/4.0/Symfony/Bridge/Doctrine/DependencyInjection/CompilerPass.html') {
            return 'STOPCAR';
        }
    }
}