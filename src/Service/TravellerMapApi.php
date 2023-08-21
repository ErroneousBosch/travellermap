<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class TravellerMapApi
{
    private Serializer $serializer;
 
    public function __construct(
        private HttpClientInterface $client)
    {
        $this->serializer = new Serializer(
            [new ObjectNormalizer()],
            [new XmlEncoder(), new JsonEncoder()]
        );
    }

    public function getAllegiances() {
        $data = $this->client->request(
            'GET',
            'https://travellermap.com/t5ss/allegiances'
        );

        return $this->serializer->decode(
            $data->getContent(),
            'json'
        );
    }

}