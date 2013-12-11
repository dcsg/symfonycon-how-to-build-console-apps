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

class CatchSignalsCommand extends Command
{
    /**
     * @var bool
     */
    private $continueFlag = true;

    protected function configure()
    {
        $this->setName('examples:catch:signals')
            ->setDescription('Example of catching signals with a Command.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        declare(ticks = 10);
        pcntl_signal(SIGINT, [$this, 'signalHandler']);

        do {
            sleep(1);
            $output->write('.');
        } while ($this->continueFlag);
    }

    /**
     * @param $signal
     */
    public function signalHandler($signal)
    {

        echo "Caught a signal: " . $signal . PHP_EOL;
        $this->continueFlag = false;
    }
}

