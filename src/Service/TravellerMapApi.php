<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class TravellerMapApi
{
 
    public function __construct(
        private HttpClientInterface $client, 
        private Serializer $serializer)
    {

    }

    public function getAllegiances() {
        $data = $this->client->request(
            'GET',
            'https://travellermap.com/api/allegiances'
        );
        return $this->serializer->deserialize(
            $data->getContent(),
            'App\Entity\Metadata[]',
            'json'
        );
    }

}