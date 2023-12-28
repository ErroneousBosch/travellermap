<?php

namespace App\Service;

use App\Kernel;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpClient\RetryableHttpClient;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Contracts\Cache\TagAwareCacheInterface;

class TravellerMapApi 
{
    private Serializer $serializer;
    private string $gitUrl = 'https://raw.githubusercontent.com/inexorabletash/travellermap/main/res/';
    private string $dataUrl = 'https://travellermap.com/data/';
    private string $dataUrl2 = 'https://travellermap.com/t5ss/';
    private string $apiUrl = 'https://travellermap.com/api/';
    private RetryableHttpClient $client;
    //tracks whether last call was changed from cached version
    public ?bool $changed = NULL;
    public array $updatedCaches = [];
 
    public function __construct(
        private Kernel $kernel,
        private TagAwareCacheInterface $cache 
    )
    {
        $this->serializer = new Serializer(
            [new ObjectNormalizer()],
            [new XmlEncoder(), new JsonEncoder(), new CsvEncoder()]
        );
        $this->client = new RetryableHttpClient(HttpClient::create(), NULL, 5);
    }

    // Rest of the code...
  


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

    //need a version of this for coordinates
    public function getSectorbyCoords($x,$y) : array {
      $data = $this->client->request(
              'GET',
            $this->apiUrl . 'metadata?sx=' . $x . '&sy=' . $y
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

public function getWorldsbyCoords($x,$y) : TravellerMapApi {
    $data = $this->client->request(
            'GET',
      $this->apiUrl . 'sec?sector=' . '?sx=' . $x . '&sy=' . $y . '&type=TabDelimited'
      );

    //   $worlds = $this->serializer->decode(
    //       $data->getContent(),
    //       'csv',
    //       [CsvEncoder::DELIMITER_KEY => "\t"]
    //   );
    //   foreach ($worlds as $key => $world) {
    //       $this->updateCache('world','none',$sector . '.' . $world['Hex'],$world);
    //   }

      return $this->serializer->decode(
        $data->getContent(),
        'csv',
        [CsvEncoder::DELIMITER_KEY => "\t"]
    );
  }
    public function getWorlds($sector) : TravellerMapApi {
      $data = $this->client->request(
              'GET',
        $this->apiUrl . 'sec?sector=' . $sector . '&type=TabDelimited'
        );

        // $worlds = $this->serializer->decode(
        //     $data->getContent(),
        //     'csv',
        //     [CsvEncoder::DELIMITER_KEY => "\t"]
        // );
        // foreach ($worlds as $key => $world) {
        //     $this->updateCache('world','none',$sector . '.' . $world['Hex'],$world);
        // }

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

    /**
     * Takes incoming $data of $mode, checks it's hash against the cached version, 
     * and if it's different, updates the cache. Returns the parsed data.
     * 
     * Returns the cache key for the data.
     * 
     * @param string $type
     * @param string $mode
     * @param string $identifier
     * @param string|array $data
     * @return string
     */
    public function updateCache(string $type, string $mode, string $identifier, string|array $data) : string {
        $ch = FALSE;
        $cacheKey = $type . '.' . $identifier;
        $hash = $this->cache->get($cacheKey.'.hash', function (ItemInterface $item) use ($data,$type,$identifier) {
            $item->tag(['api_call','api_hash','api',$type,$identifier]);
            return md5(is_string($data) ? $data : json_encode($data));
        });
        if (md5($hash) != md5(is_string($data) ? $data : json_encode($data))) {
            $this->cache->delete($cacheKey);
            $this->cache->get($cacheKey, function (ItemInterface $item) use ($data,$type,$identifier,$mode) {
                $item->tag(['api_call','api',$type,$identifier]);
                if ($mode != 'none') {
                    return $this->serializer->decode(
                        $data,
                        $mode
                    );
                }
                return $data;
            });
            $ch = TRUE;
            $this->changed ?? TRUE;
            $this->updatedCaches[$type][] = $cacheKey;
        }
        return $ch;
    }
}