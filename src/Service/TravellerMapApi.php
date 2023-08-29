<?php

namespace App\Service;

use App\Kernel;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class TravellerMapApi 
{
    private Serializer $serializer;
    private string $gitUrl = 'https://raw.githubusercontent.com/inexorabletash/travellermap/main/res/';
    private string $dataUrl = 'https://travellermap.com/data/';
    private string $dataUrl2 = 'https://travellermap.com/t5ss/';
    private string $apiUrl = 'https://travellermap.com/api/';
 
    public function __construct(
        private HttpClientInterface $client,
        private Kernel $kernel,
        )
    {
        $this->serializer = new Serializer(
            [new ObjectNormalizer()],
            [new XmlEncoder(), new JsonEncoder(), new CsvEncoder()]
        );
    }
    private function fetch($url) : string|NULL{
        $retry = 0;
        do {
          $data = $this->client->request(
              'GET',
              $url
          );
          if (($data->getStatusCode() ?? 200) != 200) {
            sleep(1);
            $retry++;
          }
        } while ($data->getStatusCode() != 200 && $retry < 5);
        return $data->getContent() ?? NULL;
      }

    public function getAllegiances() : array {
      $data = $this->fetch(
            $this->dataUrl2 . 'allegiances'
        );
        return $this->serializer->decode(
            $data,
            'json'
        );
    }

    public function getSophonts() : array {
      $data = $this->fetch(
            $this->dataUrl2 . 'sophonts'
        );

        return $this->serializer->decode(
            $data,
            'json'
        );
    }

    public function getSector($sector) : array {
      $data = $this->fetch(
            $this->apiUrl . 'metadata?sector=' . $sector
        );
        return $this->serializer->decode(
            $data,
            'json'
        );
    }

    public function getWorlds($sector) : array {
      $data = $this->fetch(
        $this->apiUrl . 'sec?sector=' . $sector . '&type=TabDelimited'
        );

        return $this->serializer->decode(
            $data,
            'csv',
            [CsvEncoder::DELIMITER_KEY => "\t"]
        );
    }       

    public function getUniverse() : array {
        $data = $this->fetch(
            $this->apiUrl . 'universe'
        );

        return $this->serializer->decode(
            $data,
            'json'
        );
    }

    public function getRemarks() : array {
        $data = file_get_contents($this->kernel->getProjectDir() . '/json/remarks.json');
        return $this->serializer->decode(
            $data,
            'json'
        );
    }

    public function getMetadata() : array {
        $data = file_get_contents($this->kernel->getProjectDir() . '/json/metadata.json');
        return $this->serializer->decode(
            $data,
            'json'
        );
    }
}