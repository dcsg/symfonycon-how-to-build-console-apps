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

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DumpDatabaseDICommand extends BaseCommand
{
    protected function configure()
    {
        $this
            ->setName('database:dump')
            ->setDescription('Dump the database.')
            ->addOption('skip-lock-tables')
            ->addOption('add-drop-database')
            ->addOption('add-drop-table')
            ->setHelp(
                'The <info>database:dump</info> will dump all tables.'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $logger = $this->container->get('logger');

        $mysqldump = $this->composeExecCommand($this->getOptions($input));

        $process = new Process($mysqldump);
        $process->run();

        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new \RuntimeException($process->getErrorOutput());
        }

        $exitCode = $process->getExitCode();

        if (0 === $exitCode) {
            $message = "<info>Success</info>";
            $logger->addInfo('Databases dumped with success');
        } else {
            $message = "<error>Error with exit code: {$exitCode}";
            $logger->addCritical('Error dumping databases.');
        }

        $output->writeln($message);
    }

    /**
     * Creates the command to be executed
     *
     * @param string $options
     * @return string
     */
    private function composeExecCommand($options)
    {
        $filename = $this->getFilename();

        $dbUser = $this->container->getParameter('database.user');
        $dbPassword = $this->container->getParameter('database.password');
        $dbHost = $this->container->getParameter('database.host');
        $dbNames = implode(' ', $this->container->getParameter('backup.databases'));

        return <<<EOF
mysqldump -u{$dbUser} -p{$dbPassword} -h{$dbHost} {$options} --databases {$dbNames} > {$filename}
EOF;
    }

    /**
     * Gets and creates in case does not exists the file
     *
     * @return string
     */
    private function getFilename()
    {
        $filename = sprintf(
            '%s/tmp/dump_%s.sql',
            $this->getApplication()->getBaseDir(),
            date('d-m-Y_hs')
        );

        if (!file_exists($filename)) {
            touch($filename);
        }

        return $filename;
    }

    private function getOptions(InputInterface $input)
    {
        $options = [];

        if ($input->hasOption('add-drop-database')) {
            $options[] = '--add-drop-database';
        }
        if ($input->hasOption('add-drop-table')) {
            $options[] = '--add-drop-table';
        }
        if ($input->hasOption('skip-lock-tables')) {
            $options[] = '--skip-lock-tables';
        }

        return implode(' ', $options);
    }
}
