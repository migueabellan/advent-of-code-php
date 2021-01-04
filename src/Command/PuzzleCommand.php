<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class PuzzleCommand extends Command
{
    protected static $defaultName = 'puzzle:exec';

    protected function configure(): void
    {
        $currentYear = (new \DateTime())->format("Y");
        $currentDay = (new \DateTime())->format("d");
        $currentPuzzle = 1;

        $this
            ->setDescription('Outputs the solutions of a Puzzles for a given event')
            ->addOption(
                'year',
                'y',
                InputOption::VALUE_REQUIRED,
                'the year of the event',
                $currentYear
            )
            ->addOption(
                'day',
                'd',
                InputOption::VALUE_REQUIRED,
                'the day of the event',
                $currentDay
            )
            ->addOption(
                'puzzle',
                'p',
                InputOption::VALUE_REQUIRED,
                'the puzzle of the day',
                $currentPuzzle
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $year = $input->getOption('year');
        $day = $input->getOption('day');
        $puzzle = $input->getOption('puzzle');

        try {
            $class = sprintf('\\App\\Year%s\\Day%s\\Puzzle', $year, $day);
            $runner = new $class();
        } catch (\Error $e) {
            $output->writeln(sprintf('<error>No class found for day %s of year %s</error>', $day, $year));
            return Command::FAILURE;
        }

        switch ($puzzle) {
            case 1:
                $array = $runner->read();
                $result = $runner->exec1($array);
                $runner->write($result);
                break;
            case 2:
                $array = $runner->read();
                $result = $runner->exec2($array);
                $runner->write($result);
                break;
            default:
                $output->writeln(sprintf('<error>No method found for puzzle %s</error>', $puzzle));
                return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
