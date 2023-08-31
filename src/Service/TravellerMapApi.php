<?php

namespace App\Service;

use App\Kernel;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpClient\RetryableHttpClient;
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
    private RetryableHttpClient $client;
 
    public function __construct(
        private Kernel $kernel,
        )
    {
        $this->serializer = new Serializer(
            [new ObjectNormalizer()],
            [new XmlEncoder(), new JsonEncoder(), new CsvEncoder()]
        );
        $this->client = new RetryableHttpClient(HttpClient::create(), NULL, 5);
    }

    public function getAllegiances() : array {
      $data = $this->client->request(
              'GET',
            $this->dataUrl2 . 'allegiances'
        );
        return $this->serializer->decode(
            $data->getContent(),
            'json'
        );
    }

    public function getSophonts() : array {
      $data = $this->client->request(
              'GET',
            $this->dataUrl2 . 'sophonts'
        );

        return $this->serializer->decode(
            $data->getContent(),
            'json'
        );
    }

    public function getSector($sector) : array {
      $data = $this->client->request(
              'GET',
            $this->apiUrl . 'metadata?sector=' . $sector
        );
        return $this->serializer->decode(
            $data->getContent(),
            'json'
        );
    }

    public function getWorlds($sector) : array {
      $data = $this->client->request(
              'GET',
        $this->apiUrl . 'sec?sector=' . $sector . '&type=TabDelimited'
        );

        return $this->serializer->decode(
            $data->getContent(),
            'csv',
            [CsvEncoder::DELIMITER_KEY => "\t"]
        );
    }       

    public function getUniverse() : array {
        $data = $this->client->request(
              'GET',
            $this->apiUrl . 'universe'
        );

        return $this->serializer->decode(
            $data->getContent(),
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