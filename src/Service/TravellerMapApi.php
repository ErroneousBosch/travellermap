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
            'https://travellermap.com/t5ss/allegiances'
        );

        return $this->serializer->decode(
            $data->getContent(),
            'json'
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

    public function getSecondSurveyMetadata() {
    $xml = file_get_contents('https://travellermap.com/doc/secondsurvey');
    libxml_use_internal_errors(true);
    $doc = new DOMDocument();
    $doc->loadHTML($xml);
    // $doc->normalizeDocument();
    $xpath = new DOMXPath($doc);
    $rows = [];
    foreach($xpath->query('//section') as $section){
        $sectionname = $section->getAttribute('id');
        foreach($xpath->query('//section[@id="' . $sectionname . '"]/table') as $table){
            $rows[] = $this->table2rows($table);
        }
        
    }
    return $rows;

    }

    private function table2rows(DOMNode $table, $headers = true){
        $keys = [];
        $rows = [];
      
        foreach($table->childNodes as $childNode){
          if ($childNode->nodeName == 'tr'){
            $row = [];
            $childNode->normalize();
            foreach($childNode->childNodes as $k => $trchildNode){
              if ($trchildNode->nodeName == 'td'){
                $v = preg_replace(['/\n/','/\s+/'],['',' '],trim($trchildNode->nodeValue));
                $row[$k] = $v;
              } elseif ($trchildNode->nodeName == 'th'){
                $keys[$k] = trim($trchildNode->nodeValue);
              }
            }
            if (count($row) == 0){
              continue;
            }
            if (count($keys) == 0 && $headers){
              $keys = $row;
            } else {
              if (count($keys) != count($row) && $headers){
                $row = array_pad($row, count($keys), end($row));
              }
              $rows[] = array_combine($keys, $row);
            }
          }
        }
        return $rows;
      }

}