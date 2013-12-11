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
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AskAndValidateCommand extends Command
{
    protected function configure()
    {
        $this->setName('examples:dialog')
            ->setDescription('Ask and Validate Helper')
            ->addArgument('first_name', InputArgument::REQUIRED, 'Your first name')
            ->addArgument('last_name', InputArgument::REQUIRED, 'Your last name');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $firstName = $input->getArgument('first_name');
        $lastName = $input->getArgument('last_name');

        $output->writeln("Your name is <info>{$firstName} {$lastName}</info>");
    }

    protected function interact(InputInterface $input, OutputInterface $output)
    {
        $firstName = $this->getHelper('dialog')->askAndValidate(
            $output,
            'Insert your first name: ',
            function ($firstName) {
                if (empty($firstName)) {
                    throw new \InvalidArgumentException('The first name cannot be empty.');
                }

                return $firstName;
            }
        );
        $input->setArgument('first_name', $firstName);

        $lastName = $this->getHelper('dialog')->askAndValidate(
            $output,
            'Insert your last name: ',
            function ($lastName) {
                if (empty($lastName)) {
                    throw new \InvalidArgumentException('The last name cannot be empty.');
                }

                return $lastName;
            }
        );
        $input->setArgument('last_name', $lastName);
    }
}

