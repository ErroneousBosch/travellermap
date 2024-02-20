<?php

namespace App\Command;

use App\Entity\World;
use App\Entity\Remark;
use App\Entity\Sector;
use App\Entity\Sophont;
use App\Entity\Metadata;
use App\Entity\Allegiance;
use App\Service\TravellerMapApi;
use Symfony\Component\Process\Process;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Exception\ProcessFailedException;


#[AsCommand(
    name: 'travellermap:update',
    description: 'Add a short description for your command',
)]
class TravellermapUpdateCommand extends Command
{

    private Serializer $serializer;

    public function __construct(
        private TravellerMapApi $travellerMapApi,
        private EntityManagerInterface $entityManager,
    )
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addOption('universe', 'u', InputOption::VALUE_NONE, 'Populate the base list of sectors')
            ->addOption('sector', 's', InputOption::VALUE_REQUIRED, 'Populate sector metadata for known sector')
            ->addOption('worlds', 'w', InputOption::VALUE_REQUIRED, 'Populate worlds for known sector')
            ->addOption('metadata', 'm', InputOption::VALUE_NONE, 'Populate metadata tables')
            ->addOption('testapi', 't', InputOption::VALUE_NONE, 'Test the API')
        ;
        $this->addArgument('arg1', InputArgument::OPTIONAL, 'Passed argument, ususally a target to update');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');

        if ($input->getOption('universe')) {
            $io->note('Populating Universe');
            $this->populateUniverse();
        }

        return Command::SUCCESS;
    }

    /**
     * This function pulls down the Universe list and uses that to populate basic sector data
     * 
     * returns void
     */
    private function populateUniverse(): void
    {
        $universe = $this->travellerMapApi->getUniverse();
        $progressBar = new ProgressBar($this->io, count($universe));
        $progressBar->start();
        foreach ($universe as $sector) {
            $progressBar->advance();
            //calculate uniqid
            $uniqid = $sector['Milieu'] . ':' . $sector['X'] . ':' . $sector['Y'];
            $sectorEntity = $this->entityManager->getRepository(Sector::class)->findOneBy(['uniqid' => $uniqid]);
            if (!$sectorEntity) {
                $sectorEntity = new Sector();
            }
            $sectorEntity->setAbbreviation($sector['Abbreviation']);
            $sectorEntity->setX($sector['X']);
            $sectorEntity->setY($sector['Y']);
            $sectorEntity->setMilieu($sector['Milieu']);
            $sectorEntity->setUniqid($uniqid);
            $this->entityManager->persist($sectorEntity);
        }
        $this->entityManager->flush();
        $progressBar->finish();
        
    }
}
