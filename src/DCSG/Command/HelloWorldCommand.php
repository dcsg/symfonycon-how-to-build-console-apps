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

class HelloWorldCommand extends Command
{
    protected function configure()
    {
        $this->setName('hello:world')
            ->setDescription('Hello World <name>');

        $this->addArgument('name', InputArgument::REQUIRED, 'Your name');
        $this->addOption('uppercase', 'u');

        $this->setHelp(<<<EOF
This is a simple command that outputs <info>Hello world</info> 'Your Name'.
EOF
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');

        if ($input->getOption('uppercase')) {
            $name = strtoupper($name);
        }

        if (preg_match("/[0-9]+/", $name)) {
            throw new \InvalidArgumentException("Invalid name \"$name\".");
        }

        $output->writeln("Hello World <info>$name</info>");
    }
}

