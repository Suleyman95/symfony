<?php
/**
 * Created by PhpStorm.
 * User: msv
 * Date: 14.05.18
 * Time: 13:37
 */

namespace App\Tests\Command;

use App\Command\CreateUserCommand;
use App\Entity\NamespaceSymfony;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;


class CreateUserCommandTest extends KernelTestCase
{
    public function testExecute()
    {
        $kernel = self::bootKernel();

        $application = new Application($kernel);
        $application->add(new CreateUserCommand());

        $command = $application->find('parse:symfony');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command' => $command->getName(),
        ));
    }
}