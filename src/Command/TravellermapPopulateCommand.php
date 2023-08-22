<?php

namespace App\Command;

use App\Service\TravellerMapApi;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'travellermap:populate',
    description: 'Add a short description for your command',
)]
class TravellermapPopulateCommand extends Command
{
    public function __construct(
        private TravellerMapApi $travellerMapApi
    ){
        parent::__construct();
    }
    protected function configure(): void
    {
        $this
            ->addOption('universe', 'u', InputOption::VALUE_NONE, 'Populate the base list of sectors')
            ->addOption('sector', 's', InputOption::VALUE_REQUIRED, 'Populate sector metadata for known sectors')
            ->addOption('worlds', 'w', InputOption::VALUE_REQUIRED, 'Populate worlds for known sectors')
            ->addOption('metadata', 'm', InputOption::VALUE_NONE, 'Populate metadata tables')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        if ($sector = $input->getOption('universe')) {
            $io->writeln('Populating worlds in sector ' . $sector);
            var_dump($this->travellerMapApi->getUniverse());
        }if ($sector = $input->getOption('sector')) {
            $io->writeln('Populating sector ' . $sector);
        } elseif ($sector = $input->getOption('worlds')) {
            $io->writeln('Populating worlds in sector ' . $sector);
            var_dump($this->travellerMapApi->getWorlds($sector));
        } else {
            $io->writeln('Populating all sectors');
            var_dump($this->travellerMapApi->getSecondSurveyMetadata());
            
        }
        

        // if ($input->getOption('option1')) {
        //     // ...
        // }

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
