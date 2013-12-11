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

class FormatterHelperCommand extends Command
{
    protected function configure()
    {
        $this->setName('examples:formatter')
            ->setDescription('Formatter Helper examples');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $formatter = $this->getHelperSet()->get('formatter');

        $formattedLine = $formatter->formatSection(
            'My Section',
            'Here is some message related to that section'
        );
        $output->writeln($formattedLine);

        $msg = array('Something went wrong');
        $formattedBlock = $formatter->formatBlock($msg, 'error');
        $output->writeln($formattedBlock);

        $msg = array('Custom Colors');
        $formattedBlock = $formatter->formatBlock($msg, 'bg=blue;fg=white');
        $output->writeln($formattedBlock);
    }
}
