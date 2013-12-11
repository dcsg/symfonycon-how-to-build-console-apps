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
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SelectDialogCommand extends Command
{
    protected function configure()
    {
        $this->setName('examples:select')
            ->setDescription('Select Helper');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $colors = array('Red', 'Yellow', 'Green', 'Blue', 'Black', 'White');
        $dialog = $this->getHelperSet()->get('dialog');
        $colorIndex = $dialog->select(
            $output,
            'Please select your favorite color:',
            $colors
        );


        $output->writeln("Your favorite color is <info>{$colors[$colorIndex]}</info>");
    }
}

