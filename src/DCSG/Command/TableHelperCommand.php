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

class TableHelperCommand extends Command
{
    protected function configure()
    {
        $this->setName('examples:table')
            ->setDescription('Table Helper example');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $table = $this->getHelperSet()->get('table');
        $table
            ->setHeaders(array('Color', 'HEX'))
            ->setRows(
                array(
                    array('Red', '#ff0000'),
                    array('Blue', '#0000ff'),
                    array('Green', '#008000'),
                    array('Yellow', '#ffff00')
                )
            );
        $table->render($output);
    }
}

