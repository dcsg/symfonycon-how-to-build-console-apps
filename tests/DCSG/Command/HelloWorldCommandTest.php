<?php
/**
 * This file is part of the Talk How to build Console Applications at SymfonyCon 2013 easy package.
 *
 * (c) Daniel Gomes <me@danielcsgomes.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DCSG\Tests;

use DCSG\Command\HelloWorldCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class HelloWorldCommandTest extends \PHPUnit_Framework_TestCase
{
    public function testOutputName()
    {
        $application = new Application();
        $application->add(new HelloWorldCommand());

        $command = $application->find('hello:world');
        $commandTester = new CommandTester($command);
        $commandTester->execute(
            array(
                 'command' => $command->getName(),
                 'name' => 'Daniel'
            )
        );

        $this->assertRegExp('/Daniel/', $commandTester->getDisplay());
    }

    public function testOutputNameInUppercase()
    {
        $command = new HelloWorldCommand();
        $commandTester = new CommandTester($command);
        $commandTester->execute(
            array(
                 'command' => $command->getName(),
                 'name' => 'Daniel',
                 '--uppercase' => true,
            )
        );

        $this->assertRegExp('/DANIEL/', $commandTester->getDisplay());
    }
}
