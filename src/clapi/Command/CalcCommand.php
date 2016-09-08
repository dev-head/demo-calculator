<?php

namespace devhead\Clapi\Command;

use \devhead\Clapi\Command;
use \Symfony\Component\Console\Input\InputInterface;
use \Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use \devhead\Calculator\Calculator;

/**
 * Class CalcCommand
 * @package devhead\Clapi\Command
 */
final class CalcCommand extends Command
{
    /**
     * Custom symfony/cli config setup.
     */
    protected function configure()
    {
        $this
            ->setName('calc')
            ->setDescription('calculate expression')
            ->addArgument('expression', InputArgument::REQUIRED, 'The expression to calculate')
        ;

        parent::configure();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('[' . __METHOD__ . ']::[started]');
        $expression = $this->getInputData('expression');

        if ($expression) {
            $calculator = new Calculator();
            $result     = $calculator->calculate($expression);
            $output->writeln('[' . $expression . '] = [' . $result . ']');
        }

        $output->writeln('[' . __METHOD__ . ']::[completed]');
    }
}