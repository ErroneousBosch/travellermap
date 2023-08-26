<?php

namespace App\Command;

use App\Entity\Allegiance;
use App\Entity\Metadata;
use App\Entity\Remark;
use App\Entity\Sector;
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
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function (object $object, string $format, array $context): string {
                return $object->getName();
            },
        ];
        $normalizer = new ObjectNormalizer(null, null, null, null, null, null, $defaultContext);
                $this->serializer = new Serializer(
            [$normalizer],
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
            $this->popSector(($sector['Abbreviation']?? $sector['Names'][0]['Text']));
        }
    }

    private function popSector ($sector, $getWorlds = false){
        $this->io->writeln('Populating metadata for sector ' . $sector);
        $sectordata = $this->travellerMapApi->getSector($sector);
        $sectordata['Name'] = $sectordata['Names'][0]['Text'];
        if (count($sectordata['Names'][0]) == 1) {
            $sectordata['Names'][0]['Lang'] = 'An';
        }
        if (!empty($sectordata['Subsectors'])){
            $sectordata['Subsectors'] = array_combine(array_column($sectordata['Subsectors'], 'Index'), array_column($sectordata['Subsectors'], 'Name'));
        }

        $sectordata['milieu'] = $sectordata['DataFile']['Milieu'];
        $sectordata['uniqid'] = $sectordata['milieu'] . ':' . (string) $sectordata['X'] . ':' . (string) $sectordata['Y'];
        $tags = $sectordata['Tags'] ?? [];
        unset($sectordata['Tags']);
        #@todo Handle remaining relevant metadata models: https://travellermap.com/doc/metadata 
        $allegiances = $sectordata['Allegiances'] ?? [];
        unset($sectordata['Allegiances']);
        $entity = $this->serializer->deserialize(
            $this->serializer->serialize($sectordata, 'json'),
            Sector::class,
            'json'
        );
        if (!empty($allegiances)){
            foreach(array_column($allegiances, 'Code') as $code){
                $allegiance = $this->allegianceRepository->findOneBy(['code' => $code]);
                $entity->addAllegiance($allegiance);
            }
            unset($sectordata['Allegiances']);
        }
        preg_match_all('/\b\w/', $sectordata['DataFile']['Source'], $matches);
        $sourcecode = implode('', $matches[0]);
        $data_file = $this->metadataRepository->findOneBy(['bundle' => 'data_source', 'code' => $sourcecode]) ?? new Metadata();
        if (empty($data_file->getId())){
            $data_file->setCode($sourcecode)
            ->setName($sectordata['DataFile']['Source'])
            ->setBundle('data_source')
            ->setExtraData($sectordata['DataFile']);

            // $this->entityManager->persist($data_file);
            // $this->entityManager->flush();
        }
        $entity->addMetadata($data_file);
        foreach ($sectordata['Products'] as $product) {
            preg_match_all('/\b\w/', $product['Title'], $matches);
            $prodcode = implode('', $matches[0]);
            $productent = $this->metadataRepository->findOneBy(['bundle' => 'product', 'code' => $prodcode]) ?? new Metadata();
            if (empty($productent->getId())){
                $productent->setCode($prodcode)
                ->setName($product['Title'])
                ->setBundle('product')
                ->setExtraData($product);
                // $this->entityManager->persist($productent);
                // $this->entityManager->flush();
            }
            $entity->addMetadata($productent);
        }
        if (!empty($sectordata['Stylesheet'])){
            $stylesheet = $this->metadataRepository->findOneBy(['bundle' => 'stylesheet', 'code' => $sectordata['uniqid']]) ?? new Metadata();
            if (empty($stylesheet->getId())){
                $stylesheet->setCode($sectordata['uniqid'])
                ->setName($sectordata['uniqid'])
                ->setBundle('stylesheet')
                ->setExtraData(['css' =>$sectordata['Stylesheet']]);
                // $this->entityManager->persist($stylesheet);
                // $this->entityManager->flush();
                $entity->addMetadata($stylesheet);
            }
        }
        foreach ($sectordata['Labels'] as $label){
            $labelent = $this->metadataRepository->findOneBy(['bundle' => 'label', 'code' => $sectordata['uniqid'] . ':' . $label['Hex'] . ':' .$label['Text']]) ?? new Metadata();
            if (empty($labelent->getId())){
                $labelent->setCode($sectordata['uniqid'] . ':' . $label['Hex'] . ':' .$label['Text'])
                ->setName($label['Text'])
                ->setBundle('label')
                ->setExtraData($label);
                // $this->entityManager->persist($labelent);
                // $this->entityManager->flush();
            }
            $entity->addMetadata($labelent);
        }
        if (!empty($tags)){
            $tags = str_contains($tags, 'OTU') ? 'OTU' : $tags;
            $tagent = $this->metadataRepository->findOneBy(['bundle' => 'tag', 'code' => $tags]) ?? new Metadata();
            if (empty($tagent->getId())){
                $tagent->setCode($tags)
                ->setName($tags)
                ->setBundle('tag');
                // $this->entityManager->persist($tagent);
                // $this->entityManager->flush();
            }
            $entity->addMetadata($tagent);
            
        }

        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }
}
