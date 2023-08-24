<?php

namespace App\Service;

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
 
    public function __construct(
        private HttpClientInterface $client)
    {
        $this->serializer = new Serializer(
            [new ObjectNormalizer()],
            [new XmlEncoder(), new JsonEncoder(), new CsvEncoder()]
        );
    }

    public function getAllegiances() {
      $data = $this->fetch(
            'https://travellermap.com/t5ss/allegiances'
        );

        return $this->serializer->decode(
            $data,
            'csv',
            [CsvEncoder::DELIMITER_KEY => "\t"]
        );
    }

    public function getSophonts() {
      $data = $this->fetch(
            'https://travellermap.com/t5ss/sophonts'
        );

        return $this->serializer->decode(
            $data,
            'csv',
            [CsvEncoder::DELIMITER_KEY => "\t"]
        );
    }

    public function getSector($sector) {
      $data = $this->fetch(
            'https://travellermap.com/data/' . $sector . '/metadata'
        );
        return $this->serializer->decode(
            $data,
            'xml'
        );
    }

    public function getWorlds($sector) {
      $data = $this->fetch(
            'https://travellermap.com/data/' . $sector . '/tab'
        );

        return $this->serializer->decode(
            $data,
            'csv',
            [CsvEncoder::DELIMITER_KEY => "\t"]
        );
    }       

    public function getUniverse() {
        $data = $this->fetch(
            'https://travellermap.com/data'
        );

        return $this->serializer->decode(
            $data,
            'json'
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
}