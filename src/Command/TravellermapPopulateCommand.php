<?php

namespace App\Command;

use App\Entity\Allegiance;
use App\Entity\Metadata;
use App\Entity\Remark;
use App\Entity\Sector;
use App\Entity\Sophont;
use App\Entity\World;
use App\Service\TravellerMapApi;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Helper\ProgressBar;
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
    private Sector $sector;
    private array $scratchpad = [];
    public function __construct(
        private TravellerMapApi $travellerMapApi,
        private EntityManagerInterface $entityManager,
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
            ->addOption('testapi', 't', InputOption::VALUE_NONE, 'Test the API')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->io = new SymfonyStyle($input, $output);

        if ($n = $input->getOption('metadata')){
            $this->popMetadata();
            $this->popRemarks();
            $this->popAllegiances();
            $this->popSophonts();
        } elseif ($sector = $input->getOption('universe')) {
            $this->popSectors();
        }if ($sector = $input->getOption('sector')) {
            $this->popSector($sector);
        } elseif ($sector = $input->getOption('worlds')) {
            $this->io->writeln('Populating worlds in sector ' . $sector);
            // var_dump($this->travellerMapApi->getWorlds($sector));
        } elseif ($sector = $input->getOption('testapi')) {
            $this->io->writeln('Testing API');
            var_dump($this->travellerMapApi->getUniverse());
        }
        // else {
        //     $this->io->writeln('Listing all sectors');
        //     // var_dump($this->travellerMapApi->getUniverse());
        // }
        

        // if ($input->getOption('option1')) {
        //     // ...
        // }

        // $this->io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }

    private function popMetadata(){
        $this->io->writeln('Populating Metadata');
            // $bundle = '';
            $dataset =  $this->travellerMapApi->getMetadata();
            $progressBar = new ProgressBar($this->io, count($dataset));
            $progressBar->start();
        foreach ($dataset as $item) {
            $progressBar->advance();
            // if ($bundle != $item['bundle']) {
            //     $bundle = $item['bundle'];
            //     $this->io->writeln('Populating bundle ' . $bundle);
            // }
            if ($existing = $this->entityManager->getRepository(Metadata::class)->findOneBy(['bundle' => $item['bundle'], 'code' => $item['code']])){
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
        $this->entityManager->clear();
        $progressBar->finish();
        
    }
    private function popRemarks(){
        $this->io->writeln('Populating Remarks');
        $dataset =  $this->travellerMapApi->getRemarks();
        $progressBar = new ProgressBar($this->io, count($dataset));
        $progressBar->start();
        foreach ($dataset as $item) {
            $progressBar->advance();
            if ($existing = $this->entityManager->getRepository(Remark::class)->findOneBy(['code' => $item['code']])){
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
        $this->entityManager->clear();
        $progressBar->finish();
    }

    private function popAllegiances(){
        $this->io->writeln('Populating Allegiances');
        $dataset =  $this->travellerMapApi->getAllegiances();
        $progressBar = new ProgressBar($this->io, count($dataset));
        $progressBar->start();
        foreach ($dataset as $item){
            $progressBar->advance();
            if ($existing = $this->entityManager->getRepository(Allegiance::class)->findOneBy(['code' => $item['Code']])){
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
        $this->entityManager->clear();
        $progressBar->finish();
    }

    private function popSophonts(){
        $this->io->writeln('Populating Sophonts');
        $dataset =  $this->travellerMapApi->getSophonts();
        $progressBar = new ProgressBar($this->io, count($dataset));
        $progressBar->start();
        foreach ($dataset as $item){
            $progressBar->advance();
            if ($existing = $this->entityManager->getRepository(Sophont::class)->findOneBy(['code' => $item['Code']])){
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
        $this->entityManager->clear();
        $progressBar->finish();
    }

    private function popSectors() {
        $this->io->writeln('Pulling Universe and Populating Sectors');
        $dataset = $this->travellerMapApi->getUniverse()['Sectors'];
        $progressBar = new ProgressBar($this->io, count($dataset));
        $progressBar->start();
        foreach ($dataset as $sector) {
            $progressBar->advance();
            $this->popSector(($sector['Abbreviation']?? $sector['Names'][0]['Text']));
        }
        $progressBar->finish();
    }

    private function popSector ($sector, $getWorlds = false){
        // $this->io->writeln('Populating metadata for sector ' . $sector);
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
        $allegiances = $sectordata['Allegiances'] ?? [];
        unset($sectordata['Allegiances']);
        $entity = $this->entityManager->getRepository(Sector::class)->findOneBy(['uniqid' => $sectordata['uniqid']]) ?? new Sector();
        $this->serializer->deserialize(
            $this->serializer->serialize($sectordata, 'json'),
            Sector::class,
            'json',
            [AbstractNormalizer::OBJECT_TO_POPULATE => $entity]
        );
        if (!empty($allegiances)){
            foreach(array_column($allegiances, 'Code') as $k => $code){
                $allegiance = $this->entityManager->getRepository(Allegiance::class)->findOneBy(['code' => $code]);
                if (empty($allegiance)){
                    $allegiance = $this->entityManager->getRepository(Allegiance::class)->findOneBy(['legacy_code' => $code]);
                }
                if (empty($allegiance)){
                    $allegiance = new Allegiance();
                    $allegiance->setCode($code);
                    $allegiance->setName($allegiances[$k]['Name']);
                }
                $entity->addAllegiance($allegiance);
            }
        }
        if (!empty($sectordata['DataFile']['Source'])){
            preg_match_all('/\b\w/', $sectordata['DataFile']['Source'], $matches);
            $sourcecode = implode('', $matches[0]);
            $data_file = $this->entityManager->getRepository(Metadata::class)->findOneBy(['bundle' => 'data_source', 'code' => $sourcecode]) ?? new Metadata();
            if (empty($data_file->getId())){
                $data_file->setCode($sourcecode)
                ->setName($sectordata['DataFile']['Source'])
                ->setBundle('data_source')
                ->setExtraData($sectordata['DataFile']);
            }
            $entity->addMetadata($data_file);
        }
        foreach ($sectordata['Products'] as $product) {
            preg_match_all('/\b\w/', $product['Title'], $matches);
            $prodcode = implode('', $matches[0]);
            $productent = $this->entityManager->getRepository(Metadata::class)->findOneBy(['bundle' => 'product', 'code' => $prodcode]) ?? new Metadata();
            if (empty($productent->getId())){
                $productent->setCode($prodcode)
                ->setName($product['Title'])
                ->setBundle('product')
                ->setExtraData($product);
            }
            $entity->addMetadata($productent);
        }
        if (!empty($sectordata['Stylesheet'])){
            $stylesheet = $this->entityManager->getRepository(Metadata::class)->findOneBy(['bundle' => 'stylesheet', 'code' => $sectordata['uniqid']]) ?? new Metadata();
            if (empty($stylesheet->getId())){
                $stylesheet->setCode($sectordata['uniqid'])
                ->setName($sectordata['uniqid'])
                ->setBundle('stylesheet')
                ->setExtraData(['css' =>$sectordata['Stylesheet']]);
                $entity->addMetadata($stylesheet);
            }
        }
        foreach ($sectordata['Labels'] as $label){
            $labelent = $this->entityManager->getRepository(Metadata::class)->findOneBy(['bundle' => 'label', 'code' => $sectordata['uniqid'] . ':' . $label['Hex'] . ':' .$label['Text']]) ?? new Metadata();
            if (empty($labelent->getId())){
                $labelent->setCode($sectordata['uniqid'] . ':' . $label['Hex'] . ':' .$label['Text'])
                ->setName($label['Text'])
                ->setBundle('label')
                ->setExtraData($label);
            }
            $entity->addMetadata($labelent);
        }
        if (!empty($tags)){
            $tags = str_contains($tags, 'OTU') ? 'OTU' : $tags;
            $tagent = $this->entityManager->getRepository(Metadata::class)->findOneBy(['bundle' => 'tag', 'code' => $tags]) ?? new Metadata();
            if (empty($tagent->getId())){
                $tagent->setCode($tags)
                ->setName($tags)
                ->setBundle('tag');
            }
            $entity->addMetadata($tagent);
        }
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
        $this->entityManager->clear();
    }


private function popWorld($data){
        // $this->io->writeln('Populating world ' . $data['Name']);
        $data['uniqid'] = $this->sector->getUniqid() . ':' . $data['Hex'];
        $data['sector'] = $this->sector;
        $data['subsector'] = $data['SS'];
        unset($data['SS']);
        //process {Ix}	(Ex)	[Cx]
        $data['Ix'] = trim($data['{Ix}'], '{ }') ?? 0;
        $data['Ex'] = trim($data['(Ex)'], '( )') ?? 0;
        $data['Cx'] = trim($data['[Cx]'], '[ ]') ?? 0;
        unset($data['[Cx]'], $data['(Ex)'], $data['{Ix}']);
        $remarks = explode(' ', $data['Remarks']) ?? [];
        unset($data['Remarks']);
        $data['bodies'] = $data['W'] ?? 0;
        unset($data['W']);
        $world = $this->entityManager->getRepository(World::class)->findOneBy(['uniqid' => $data['uniqid']]) ?? new World();
        $world = $this->serializer->deserialize(
            $this->serializer->serialize($data, 'json'),
            World::class,
            'json',
            [AbstractNormalizer::OBJECT_TO_POPULATE => $world]
        );

        foreach($remarks as $remark){
            $remarkent = $this->entityManager->getRepository(Remark::class)->findOneBy(['code' => $remark]) ?? new Remark();
            if (empty($remarkent->getId())){
                $remarkent->setCode($remark)
                ->setUniqid($remark);
                if (str_contains($remark, 'Mr(')){
                    $allegiance = $this->entityManager->getRepository(Allegiance::class)->findOneBy(['code' => substr($remark, 3, 4)]);
                    $descr = "Military Rule by " . $allegiance->getName();
                    $remarkent->setAllegiance($allegiance);
                } elseif (str_contains($remark, 'O:')){
                    $this->scratchpad[] = [
                        'world' => $world->getUniqid(),
                        'remark' => $remark
                    ];
                } elseif (str_contains($remark, 'Di(')){
                    $sophont = $this->entityManager->getRepository(Sophont::class)->findOneBy(['name' => substr($remark, 3, strlen($remark) - 4)]);
                    $remarkent->setSophonts($sophont);
                    $descr = "Homeworld of  " . $sophont->getName() . ' (extinct)';
                } elseif (str_contains($remark, '(') || str_contains($remark, '[')){
                    $pops = '100% of population';
                    if (is_numeric(substr($remark, -1, 1))){
                        $pops = substr($remark, -1, 1) . '0% of population';
                        $remark = substr($remark, 0, strlen($remark) - 1);
                    } 
                    $sophont = $this->entityManager->getRepository(Sophont::class)->findOneBy(['name' => trim($remark, '()[] ')]);
                    $remarkent->setSophonts($sophont);
                    $descr = "Homeworld of  " . $sophont->getName() . ' (' . $pops . ')';
                } elseif (str_contains($remark, '{')){
                    $descr = trim($remark, '{}');
                } elseif (strlen($remark = 5 && (is_numeric(substr($remark,-1,1)) || substr($remark,-1,1) == 'W'))){
                    $pops = '100% of population';
                    if (is_numeric(substr($remark, -1, 1))){
                        $pops = substr($remark, -1, 1) . '0% of population';
                        $remark = substr($remark, 0, strlen($remark) - 1);
                    }
                    $sophont = $this->entityManager->getRepository(Sophont::class)->findOneBy(['code' => substr($remark, 0, strlen($remark) - 1)]);
                    $remarkent->setSophonts($sophont);
                    $descr = $sophont->getName() . ' population (' . $pops . ')';
                }

                $remarkent->setDescription($descr);
            }
            $world->addRemark($remarkent);
        }
        $this->entityManager->persist($world);
        $this->entityManager->flush();
        $this->entityManager->clear();
    }

    private function popWorlds() {
        $this->io->writeln('Pulling Worlds for sector ' . $this->sector->getName());
        $dataset = $this->travellerMapApi->getWorlds($this->sector->getAbbreviation());
        $progressBar = new ProgressBar($this->io, count($dataset));
        $progressBar->start();
        foreach ($dataset as $world) {
            $progressBar->advance();
            $this->popWorld($world);
        }
        $progressBar->finish();
        $this->io->writeln('Populating remarks for sector ' . $this->sector->getName());
        $progressBar = new ProgressBar($this->io, count($this->scratchpad));
        $progressBar->start();
        foreach ($this->scratchpad as $item){
            $progressBar->advance();
            $item['remark'] = trim($item['remark'], 'O:');
            $world = $this->entityManager->getRepository(World::class)->findOneBy(['uniqid' => $item['world']]);
            $remark = $this->entityManager->getRepository(Remark::class)->findOneBy(['code' => $item['remark']]) ?? new Remark();
            if (empty($remark->getId())){
                if(str_contains($remark, '-')){
                    $data = explode('-', $remark);
                    $item['remark'] = $data[1];
                    $sector = $this->entityManager->getRepository(Sector::class)->findOneBy(['abbreviation' => $data[0]]);
                }
                $owner = $this->entityManager->getRepository(World::class)->findOneBy(['sector' => ($sector ?? $this->sector), 'hex' => $item['remark']]);
                $remark->setCode($item['remark'])
                ->setUniqid($item['remark'])
                ->setDescription('Controlled by' . $owner->getName() . ' (' . $owner->getAllegiance()->getName() . ')');
            }
            $world->addRemark($remark);
            $this->entityManager->persist($world);
            $this->entityManager->flush();
            $this->entityManager->clear();
        }
        $this->scratchpad = [];
        $progressBar->finish();
    }
}
