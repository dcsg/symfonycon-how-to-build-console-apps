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

class ProgressHelperCommand extends Command
{
    protected function configure()
    {
        $this->setName('examples:progress')
            ->setDescription('Progress Helper example');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $progress = $this->getHelperSet()->get('progress');

        $progress->start($output, 10);

        $i = 0;
        while ($i++ < 10) {
            sleep(1);
            $progress->advance();
        }

        $progress->finish();
    }
}

