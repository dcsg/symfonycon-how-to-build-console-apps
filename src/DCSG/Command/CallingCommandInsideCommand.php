<?php
/**
 * This file is part of the Talk How to build Console Applications at SymfonyCon 2013 easy package.
 *
 * (c) Daniel Gomes <me@danielcsgomes.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DCSG\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CallingCommandInsideCommand extends Command
{
    protected function configure()
    {
        $this->setName('examples:calling:command')
            ->setDescription('Example of calling a Command inside another Command.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $command = $this->getApplication()->find('hello:world');

        $arguments = array(
            'command' => 'hello:world',
            'name' => 'Daniel Gomes'
        );

        $returnCode = $command->run(new ArrayInput($arguments), $output);
        $output->writeln("Exit code $returnCode");
    }
}

