<?php

namespace App\Command;

use App\Entity\Allegiance;
use App\Entity\Metadata;
use App\Entity\Remark;
use App\Entity\Sophont;
use App\Repository\AllegianceRepository;
use App\Repository\MetadataRepository;
use App\Repository\RemarkRepository;
use App\Repository\SectorRepository;
use App\Repository\SophontRepository;
use App\Repository\WorldRepository;
use App\Service\TravellerMapApi;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

#[AsCommand(
    name: 'travellermap:populate',
    description: 'Add a short description for your command',
)]
class TravellermapPopulateCommand extends Command
{
    private Serializer $serializer;
    private SymfonyStyle $io;
    public function __construct(
        private TravellerMapApi $travellerMapApi,
        private EntityManagerInterface $entityManager,
        private MetadataRepository $metadataRepository,
        private SophontRepository $sophontRepository,
        private AllegianceRepository $allegianceRepository,
        private RemarkRepository $remarkRepository,
        private SectorRepository $sectorRepository,
        private WorldRepository $worldRepository,
    ){
        parent::__construct();
                $this->serializer = new Serializer(
            [new ObjectNormalizer()],
            [new XmlEncoder(), new JsonEncoder(), new CsvEncoder()]
        );

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
        $this->io = new SymfonyStyle($input, $output);

        if ($sector = $input->getOption('universe')) {
            $this->popSectors();
        }if ($sector = $input->getOption('sector')) {
            $this->popSector($sector);
        } elseif ($sector = $input->getOption('worlds')) {
            $this->io->writeln('Populating worlds in sector ' . $sector);
            var_dump($this->travellerMapApi->getWorlds($sector));
        } elseif ($n = $input->getOption('metadata')){
            $this->popMetadata();
            $this->popRemarks();
            $this->popAllegiances();
            $this->popSophonts();
        }else {
            $this->io->writeln('Listing all sectors');
            var_dump($this->travellerMapApi->getUniverse());
        }
        

        // if ($input->getOption('option1')) {
        //     // ...
        // }

        // $this->io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }

    private function popMetadata(){
        $this->io->writeln('Populating Metadata');
            // $bundle = '';
            foreach ($this->travellerMapApi->getMetadata() as $item) {
                // if ($bundle != $item['bundle']) {
                //     $bundle = $item['bundle'];
                //     $this->io->writeln('Populating bundle ' . $bundle);
                // }
                if ($existing = $this->metadataRepository->findOneBy(['bundle' => $item['bundle'], 'code' => $item['code']])){
                    $metadata = $this->serializer->deserialize(
                        $this->serializer->serialize($item, 'json'),
                        Metadata::class,
                        'json',
                        [AbstractNormalizer::OBJECT_TO_POPULATE => $existing]
                    );
                } else {
                    $metadata = $this->serializer->deserialize(
                        $this->serializer->serialize($item, 'json'),
                        Metadata::class,
                        'json'
                    );
                }
                $this->entityManager->persist($metadata);
            }
            $this->entityManager->flush();
    }
    private function popRemarks(){
        $this->io->writeln('Populating Remarks');
        foreach ($this->travellerMapApi->getRemarks() as $item) {
            if ($existing = $this->remarkRepository->findOneBy(['code' => $item['code']])){
                $remark = $this->serializer->deserialize(
                    $this->serializer->serialize($item, 'json'),
                    Remark::class,
                    'json',
                    [AbstractNormalizer::OBJECT_TO_POPULATE => $existing]
                );
            } else {
                $item['uniqid'] = $item['code'];
                $remark = $this->serializer->deserialize(
                    $this->serializer->serialize($item, 'json'),
                    Remark::class,
                    'json'
                );
            }
            $this->entityManager->persist($remark);
        }
        $this->entityManager->flush();
    }

    private function popAllegiances(){
        $this->io->writeln('Populating Allegiances');
        foreach ($this->travellerMapApi->getAllegiances() as $item){
            if ($existing = $this->allegianceRepository->findOneBy(['code' => $item['Code']])){
                $allegiance = $this->serializer->deserialize(
                    $this->serializer->serialize($item, 'json'),
                    Allegiance::class,
                    'json',
                    [AbstractNormalizer::OBJECT_TO_POPULATE => $existing]
                );
            } else {
                $allegiance = $this->serializer->deserialize(
                    $this->serializer->serialize($item, 'json'),
                    Allegiance::class,
                    'json'
                );
            }
            $this->entityManager->persist($allegiance);
        }
        $this->entityManager->flush();
    }

    private function popSophonts(){
        $this->io->writeln('Populating Sophonts');
        foreach ($this->travellerMapApi->getSophonts() as $item){
            if ($existing = $this->sophontRepository->findOneBy(['code' => $item['Code']])){
                $sophont = $this->serializer->deserialize(
                    $this->serializer->serialize($item, 'json'),
                    Sophont::class,
                    'json',
                    [AbstractNormalizer::OBJECT_TO_POPULATE => $existing]
                );
            } else {
                $sophont = $this->serializer->deserialize(
                    $this->serializer->serialize($item, 'json'),
                    Sophont::class,
                    'json'
                );
            }
            $this->entityManager->persist($sophont);
        }
        $this->entityManager->flush();
    }

    private function popSectors() {
        $this->io->writeln('Pulling Universe and Populating Sectors');
        foreach ($this->travellerMapApi->getUniverse()['Sectors'] as $sector) {
            $sector['Abbreviation'] = $sector['Abbreviation'] ?? $sector['Names'][0]['Text'];
            $sectordata = $this->travellerMapApi->getSector($sector['Names'][0]['Text']);
            // $sectordata['uniqid'] =  $sector['Milieu'] . ':' . (string) $sector['X'] . ':' . (string) $sector['Y'];

            // var_dump($sectordata);
        }
    }

    private function popSector ($sector, $getWorlds = false){
        $this->io->writeln('Populating metadata for sector ' . $sector);
        $sectordata = $this->travellerMapApi->getSector($sector);
        var_dump($sectordata);
    }
}
