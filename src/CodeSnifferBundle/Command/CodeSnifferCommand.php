<?php

namespace CodeSnifferBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

class CodeSnifferCommand extends ContainerAwareCommand
{

    const TOOL_SNIFF            = 'phpcs';
    const TOOL_FIX              = 'phpcbf';
    const CODE_SNIFFER_STANDARD = 'PSR2';

    protected function configure()
    {
        $this
            ->setName('code:sniff')
            ->setDescription('Run/Fix phpcs codesniffer')
            ->addOption('fix', 'f', InputOption::VALUE_NONE, 'Fix violations that can be fixed automatically')
            ->addArgument('standards', (InputArgument::OPTIONAL | InputArgument::IS_ARRAY), 'Standards to check');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $command = self::TOOL_SNIFF;
        if ($input->getOption('fix')) {
            $command = self::TOOL_FIX;
        }

        $standards = self::CODE_SNIFFER_STANDARD;
        if ($input->getArgument('standards')) {
            $standards = implode(',', $input->getArgument('standards'));
        }

        $cmd = 'vendor/bin/'.$command.' --standard='.$standards.' -p -n src/';

        $process = new Process($cmd, realpath(__DIR__.'/../../../'), null, null, 9600);
        $process->run(
            function ($type, $buffer) {
                echo $buffer;
            }
        );
    }
}