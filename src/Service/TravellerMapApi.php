<?php

namespace App\Service;

use DOMDocument;
use DOMNode;
use DOMXPath;
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
        $data = $this->client->request(
            'GET',
            $this->gitUrl . '/t5ss/allegiance_codes.tab'
        );

        return $this->serializer->decode(
            $data->getContent(),
            'csv',
            [CsvEncoder::DELIMITER_KEY => "\t"]
        );
    }

    public function getSophonts() {
        $data = $this->client->request(
            'GET',
            $this->gitUrl . '/t5ss/sophont_codes.tab'
        );

        return $this->serializer->decode(
            $data->getContent(),
            'csv',
            [CsvEncoder::DELIMITER_KEY => "\t"]
        );
    }

    public function getSector($sector) {
        $data = $this->client->request(
            'GET',
            'https://travellermap.com/data/' . $sector . '/metadata'
        );
        return $this->serializer->decode(
            $data->getContent(),
            'xml'
        );
    }

    public function getWorlds($sector) {
        $data = $this->client->request(
            'GET',
            'https://travellermap.com/data/' . $sector . '/tab'
        );

        return $this->serializer->decode(
            $data->getContent(),
            'csv',
            [CsvEncoder::DELIMITER_KEY => "\t"]
        );
    }       

    public function getUniverse() {
        $data = $this->client->request(
            'GET',
            'https://travellermap.com/data'
        );

        return $this->serializer->decode(
            $data->getContent(),
            'json'
        );
    }

}