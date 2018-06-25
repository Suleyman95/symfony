<?php


namespace App\Command;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DomCrawler\Crawler;

class YouDo extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('parse:youdo')

            // the short description shown while running "php bin/console list"
            ->setDescription('Creates a new user.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command allows you to create a user...')
//            ->addOption(
//                'node',
//                null,
//                InputOption::VALUE_REQUIRED,
//                'How many times should the message be printed?',
//                2
//            );
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = "Виктор К.";
        $baseurl = "https://youdo.com/executors-courier";
        $count = 0;

        for ($i = 1; $i <= 127; $i++) {

            $url = $baseurl;
            $html = file_get_contents($url . "-$i");
            $crawler = new Crawler($html);

            $names = $crawler->filter('.b-executor-item__name');

            foreach ($names as $values) {
                $count++;
                var_dump($values->textContent);
                var_dump($count);
                if ($values->textContent == $name) {
                    var_dump($values->textContent);
                    var_dump($values->getAttribute('href'));
                    exit();
                }
            }
        }

    }
}