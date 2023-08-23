<?php

use App\Kernel;


require_once __DIR__.'/vendor/autoload_runtime.php';


$kernel = new Kernel('dev', true);
$kernel->boot();
$container = $kernel->getContainer();
$api = $container->get('App\Service\TravellerMapApi');
 
$adat = $api->getAllegiances();
var_dump($adat);
/*




// use Symfony\Component\Serializer\Encoder\JsonEncoder;
// use Symfony\Component\Serializer\Encoder\XmlEncoder;
// use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
// use Symfony\Component\Serializer\Serializer;



// $encoders = [new XmlEncoder(), new JsonEncoder()];
// $normalizers = [new ObjectNormalizer()];

// $serializer = new Serializer($normalizers, $encoders);
libxml_use_internal_errors(true);
$xml = file_get_contents('https://travellermap.com/doc/secondsurvey');

$doc = new DOMDocument();
$doc->loadHTML($xml);
$doc->normalizeDocument();
$norm = new Normalizer();

$xpath = new DOMXpath($doc);

$data = [];
foreach($xpath->query('//section/table') as $sectiontable){
  $sectionname = $sectiontable->parentNode->getAttribute('id');
  foreach($sectiontable->childNodes as $childNode){

  }
  $data[$sectionname] = $data[$sectionname] ?? [];
  $data[$sectionname] += table2rows($sectiontable);
  // match ($sectionname){
  //   'allegiance' => table2rows($sectiontable),
  //   'atmosphere' => table2rows($sectiontable),
  //   'bases' => table2rows($sectiontable),
  //   'ehex' => table2rows($sectiontable),
  //   'government' => table2rows($sectiontable),
  //   'hydrographics' => table2rows($sectiontable),
  //   'law_level' => table2rows($sectiontable),
  //   'nobility' => table2rows($sectiontable),
  //   'population_exponent' => table2rows($sectiontable),
  //   'remarks' => table2rows($sectiontable),
  //   'size' => table2rows($sectiontable),
  //   'sophont' => table2rows($sectiontable),
  //   'starport' => table2rows($sectiontable),
  //   'stellar' => table2rows($sectiontable),
  //   'tech_level' => table2rows($sectiontable),
  //   'uwp' => table2rows($sectiontable, false),
  //   'zone' => table2rows($sectiontable),
  //   default => table2rows($sectiontable),
  // };


  // foreach($sectiontable->childNodes as $childNode){
  //   if ($childNode->nodeName == 'tr'){
  //     // $childNode->normalize();
  //     echo count($childNode->childNodes) . "\n";
  //     foreach($childNode->childNodes as $k => $trchildNode){
  //       echo $trchildNode->nodeName . "\n";
  //       if ($trchildNode->nodeName == 'td'){
  //         echo $k . ' : ' .$trchildNode->nodeValue . "\n";
  //       }
  //     }
  //   }
  // }
  // var_dump($sectiontable->nodeValue);
}

file_put_contents('json/secondsurvey.json', json_encode($data, JSON_PRETTY_PRINT));
// $xml = file_get_contents('https://travellermap.com/doc/secondsurvey');
// var_dump($serializer->decode($xml, 'xml'));
$data = [];

function table2rows(DOMNode $table, $headers = true){
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


*/


$data['STARPORT_TABLE'] = [
  // Starports
  ['bundle' => 'starport','abbreviation' => 'A', 'description' => 'Excellent', 'extra_data' => ['long_description' => 'Excellent Quality. Refined fuel available. Annual maintenance overhaul available. Shipyard capable of constructing starships and non-starships present. Naval base and\/or scout base may be present.']],
  ['bundle' => 'starport','abbreviation' => 'B', 'description' => 'Good', 'extra_data' => ['long_description' => 'Good Quality. Refined fuel available. Annual maintenance overhaul available. Shipyard capable of constructing non-starships present. Naval base and\/or scout base may be present.']],
  ['bundle' => 'starport','abbreviation' => 'C', 'description' => 'Routine', 'extra_data' => ['long_description' => 'Routine Quality. Only unrefined fuel available. Reasonable repair facilities present. Scout base may be present.']],
  ['bundle' => 'starport','abbreviation' => 'D', 'description' => 'Poor', 'extra_data' => ['long_description' => 'Poor Quality. Only unrefined fuel available. No repair facilities present. Scout base may be present.']],
  ['bundle' => 'starport','abbreviation' => 'E', 'description' => 'Frontier Installation', 'extra_data' => ['long_description' => 'Frontier Installation. Essentially a marked spot of bedrock with no fuel, facilities, or bases present.']],
  ['bundle' => 'starport','abbreviation' => 'X', 'description' => 'None or Unknown', 'extra_data' => ['long_description' => 'No Starport. No provision is made for any ship landings.']],
  ['bundle' => 'starport','abbreviation' => 'F', 'description' => 'Good', 'extra_data' => ['long_description' => '(Spaceport) Good Quality. Minor damage repairable. Unrefined fuel available.']],
  ['bundle' => 'starport','abbreviation' => 'G', 'description' => 'Poor', 'extra_data' => ['long_description' => '(Spaceport) Poor Quality. Limited repair capability. Only unrefined fuel available.']],
  ['bundle' => 'starport','abbreviation' => 'H', 'description' => 'Primitive', 'extra_data' => ['long_description' => '(Spaceport) Primitive. No repair capability. No repairs available.']],
  ['bundle' => 'starport','abbreviation' => 'Y', 'description' => 'None', 'extra_data' => ['long_description' => 'No Starport. No provision is made for any ship landings.']],
  ['bundle' => 'starport','abbreviation' => '?', 'description' => 'Unknown', 'extra_data' => ['long_description' => 'No information or starport classification found.]']
];

$data['SIZ_TABLE'] = [
  ['bundle'=> 'world_size', 'abbreviation'=>'0', 'description' => 'Asteroid Belt'],
  ['bundle'=> 'world_size', 'abbreviation'=>'S', 'description' => 'Small World'],
  ['bundle'=> 'world_size', 'abbreviation'=>'1', 'description' => '1,600km (0.12g)', 'extra_data' => ['diameter' => 1600, 'mass' => 0.0019, 'area'=> 0.015, 'gravity' => 0.122, 'esc_velocity' => 1.35]],
  ['bundle'=> 'world_size', 'abbreviation'=>'2', 'description' => '3,200km (0.25g)', 'extra_data' => ['diameter' => 3200, 'mass' => 0.015, 'area'=> 0.063, 'gravity' => 0.240, 'esc_velocity' => 2.69]],
  ['bundle'=> 'world_size', 'abbreviation'=>'3', 'description' => '4,800km (0.38g)', 'extra_data' => ['diameter' => 4800, 'mass' => 0.053, 'area'=> 0.141, 'gravity' => 0.377, 'esc_velocity' => 4.13]],
  ['bundle'=> 'world_size', 'abbreviation'=>'4', 'description' => '6,400km (0.50g)', 'extra_data' => ['diameter' => 6400, 'mass' => 0.125, 'area'=> 0.250, 'gravity' => 0.500, 'esc_velocity' => 5.49]],
  ['bundle'=> 'world_size', 'abbreviation'=>'5', 'description' => '8,000km (0.63g)', 'extra_data' => ['diameter' => 8000, 'mass' => 0.244, 'area'=> 0.391, 'gravity' => 0.625, 'esc_velocity' => 6.87]],
  ['bundle'=> 'world_size', 'abbreviation'=>'6', 'description' => '9,600km (0.75g)', 'extra_data' => ['diameter' => 9600, 'mass' => 0.422, 'area'=> 0.563, 'gravity' => 0.840, 'esc_velocity' => 8.72]],
  ['bundle'=> 'world_size', 'abbreviation'=>'7', 'description' => '11,200km (0.88g)', 'extra_data' => ['diameter' => 11200, 'mass' => 0.670, 'area'=> 0.766, 'gravity' => 0.875, 'esc_velocity' => 9.62]],
  ['bundle'=> 'world_size', 'abbreviation'=>'8', 'description' => '12,800km (1.0g)', 'extra_data' => ['diameter' => 12800, 'mass' => 1.000, 'area'=> 1.000, 'gravity' => 1.000, 'esc_velocity' => 11.00]],
  ['bundle'=> 'world_size', 'abbreviation'=>'9', 'description' => '14,400km (1.12g)', 'extra_data' => ['diameter' => 14400, 'mass' => 1.424, 'area'=> 1.266, 'gravity' => 1.120, 'esc_velocity' => 12.35]],
  ['bundle'=> 'world_size', 'abbreviation'=>'A', 'description' => '16,000km (1.25g)', 'extra_data' => ['diameter' => 16000, 'mass' => 1.953, 'area'=> 1.563, 'gravity' => 1.250, 'esc_velocity' => 13.73]],
  ['bundle'=> 'world_size', 'abbreviation'=>'B', 'description' => '17,600km (1.38g)', 'extra_data' => ['diameter' => 18800, 'mass' => 2.600, 'area'=> 1.891, 'gravity' => 1.375, 'esc_velocity' => 15.34]],
  ['bundle'=> 'world_size', 'abbreviation'=>'C', 'description' => '19,200km (1.50g)', 'extra_data' => ['diameter' => 19200, 'mass' => 3.375, 'area'=> 2.250, 'gravity' => 1.500, 'esc_velocity' => 16.74]],
  ['bundle'=> 'world_size', 'abbreviation'=>'D', 'description' => '20,800km (1.63g)', 'extra_data' => ['diameter' => 20800, 'mass' => 4.291, 'area'=> 2.641, 'gravity' => 1.625, 'esc_velocity' => 18.13]],
  ['bundle'=> 'world_size', 'abbreviation'=>'E', 'description' => '22,400km (1.75g)', 'extra_data' => ['diameter' => 22400, 'mass' => 5.359, 'area'=> 3.063, 'gravity' => 1.750, 'esc_velocity' => 19.52]],
  ['bundle'=> 'world_size', 'abbreviation'=>'F', 'description' => '24,000km (2.0g)', 'extra_data' => ['diameter' => 24000, 'mass' => 6.592, 'area'=> 3.516, 'gravity' => 1.875, 'esc_velocity' => 20.92]],
  ['bundle'=> 'world_size', 'abbreviation'=>'X', 'description' => 'Unknown'],
  ['bundle'=> 'world_size', 'abbreviation'=>'?', 'description'=> 'Unknown'],
];

$data['atmosphere'] = [
  ['bundle' => 'atmosphere', 'abbreviation' => '0', 'description' => 'No atmosphere'],
  ['bundle' => 'atmosphere', 'abbreviation' => '1', 'description' => 'Trace'],
  ['bundle' => 'atmosphere', 'abbreviation' => '2', 'description' => 'Very thin; Tainted'],
  ['bundle' => 'atmosphere', 'abbreviation' => '3', 'description' => 'Very thin'],
  ['bundle' => 'atmosphere', 'abbreviation' => '4', 'description' => 'Thin; Tainted'],
  ['bundle' => 'atmosphere', 'abbreviation' => '5', 'description' => 'Thin'],
  ['bundle' => 'atmosphere', 'abbreviation' => '6', 'description' => 'Standard'],
  ['bundle' => 'atmosphere', 'abbreviation' => '7', 'description' => 'Standard; Tainted'],
  ['bundle' => 'atmosphere', 'abbreviation' => '8', 'description' => 'Dense'],
  ['bundle' => 'atmosphere', 'abbreviation' => '9', 'description' => 'Dense; Tainted'],
  ['bundle' => 'atmosphere', 'abbreviation' => 'A', 'description' => 'Exotic'],
  ['bundle' => 'atmosphere', 'abbreviation' => 'B', 'description' => 'Corrosive'],
  ['bundle' => 'atmosphere', 'abbreviation' => 'C', 'description' => 'Insidious'],
  ['bundle' => 'atmosphere', 'abbreviation' => 'D', 'description' => 'Dense, high'],
  ['bundle' => 'atmosphere', 'abbreviation' => 'E', 'description' => 'Thin, low'],
  ['bundle' => 'atmosphere', 'abbreviation' => 'F', 'description' => 'Unusual'],
  ['bundle' => 'atmosphere', 'abbreviation' => 'X', 'description' => 'Unknown'],
  ['bundle' => 'atmosphere', 'abbreviation' => '?', 'description'=> 'Unknown'],
];

$data['hydrographics'] = [
  ['bundle' => 'hydrographics', 'abbreviation' => '0', 'description' => 'Desert World'],
  ['bundle' => 'hydrographics', 'abbreviation' => '1', 'description' => '10%'],
  ['bundle' => 'hydrographics', 'abbreviation' => '2', 'description' => '20%'],
  ['bundle' => 'hydrographics', 'abbreviation' => '3', 'description' => '30%'],
  ['bundle' => 'hydrographics', 'abbreviation' => '4', 'description' => '40%'],
  ['bundle' => 'hydrographics', 'abbreviation' => '5', 'description' => '50%'],
  ['bundle' => 'hydrographics', 'abbreviation' => '6', 'description' => '60%'],
  ['bundle' => 'hydrographics', 'abbreviation' => '7', 'description' => '70%'],
  ['bundle' => 'hydrographics', 'abbreviation' => '8', 'description' => '80%'],
  ['bundle' => 'hydrographics', 'abbreviation' => '9', 'description' => '90%'],
  ['bundle' => 'hydrographics', 'abbreviation' => 'A', 'description' => 'Water World'],
  ['bundle' => 'hydrographics', 'abbreviation' => 'X', 'description' => 'Unknown'],
  ['bundle' => 'hydrographics', 'abbreviation' => '?', 'description'=> 'Unknown'],
];

$data['POP_TABLE'] = [
  ['bundle' => 'population_exponent', 'abbreviation' => '0', 'description' => 'Unpopulated'],
  ['bundle' => 'population_exponent', 'abbreviation' => '1', 'description' => 'Tens'],
  ['bundle' => 'population_exponent', 'abbreviation' => '2', 'description' => 'Hundreds'],
  ['bundle' => 'population_exponent', 'abbreviation' => '3', 'description' => 'Thousands'],
  ['bundle' => 'population_exponent', 'abbreviation' => '4', 'description' => 'Tens of thousands'],
  ['bundle' => 'population_exponent', 'abbreviation' => '5', 'description' => 'Hundreds of thousands'],
  ['bundle' => 'population_exponent', 'abbreviation' => '6', 'description' => 'Millions'],
  ['bundle' => 'population_exponent', 'abbreviation' => '7', 'description' => 'Tens of millions'],
  ['bundle' => 'population_exponent', 'abbreviation' => '8', 'description' => 'Hundreds of millions'],
  ['bundle' => 'population_exponent', 'abbreviation' => '9', 'description' => 'Billions'],
  ['bundle' => 'population_exponent', 'abbreviation' => 'A', 'description' => 'Tens of billions'],
  ['bundle' => 'population_exponent', 'abbreviation' => 'B', 'description' => 'Hundreds of billions'],
  ['bundle' => 'population_exponent', 'abbreviation' => 'C', 'description' => 'Trillions'],
  ['bundle' => 'population_exponent', 'abbreviation' => 'D', 'description' => 'Tens of trillions'],
  ['bundle' => 'population_exponent', 'abbreviation' => 'E', 'description' => 'Hundreds of tillions'],
  ['bundle' => 'population_exponent', 'abbreviation' => 'F', 'description' => 'Quadrillions'],
  ['bundle' => 'population_exponent', 'abbreviation' => 'X', 'description' => 'Unknown'],
  ['bundle' => 'population_exponent', 'abbreviation' => '?', 'description'=> 'Unknown'],
];

$data['GOV_TABLE'] = [
  ['bundle' => 'government', 'abbreviation' => '0', 'description' => 'No Government Structure'],
  ['bundle' => 'government', 'abbreviation' => '1', 'description' => 'Company/Corporation'],
  ['bundle' => 'government', 'abbreviation' => '2', 'description' => 'Participating Democracy'],
  ['bundle' => 'government', 'abbreviation' => '3', 'description' => 'Self-Perpetuating Oligarchy'],
  ['bundle' => 'government', 'abbreviation' => '4', 'description' => 'Representative Democracy'],
  ['bundle' => 'government', 'abbreviation' => '5', 'description' => 'Feudal Technocracy'],
  ['bundle' => 'government', 'abbreviation' => '6', 'description' => 'Captive Government / Colony'],
  ['bundle' => 'government', 'abbreviation' => '7', 'description' => 'Balkanization'],
  ['bundle' => 'government', 'abbreviation' => '8', 'description' => 'Civil Service Bureaucracy'],
  ['bundle' => 'government', 'abbreviation' => '9', 'description' => 'Impersonal Bureaucracy'],
  ['bundle' => 'government', 'abbreviation' => 'A', 'description' => 'Charismatic Dictator'],
  ['bundle' => 'government', 'abbreviation' => 'B', 'description' => 'Non-Charismatic Dictator'],
  ['bundle' => 'government', 'abbreviation' => 'C', 'description' => 'Charismatic Oligarchy'],
  ['bundle' => 'government', 'abbreviation' => 'D', 'description' => 'Religious Dictatorship'],
  ['bundle' => 'government', 'abbreviation' => 'E', 'description' => 'Religious Autocracy'],
  ['bundle' => 'government', 'abbreviation' => 'F', 'description' => 'Totalitarian Oligarchy'],
  ['bundle' => 'government', 'abbreviation' => 'X', 'description' => 'Unknown'],
  ['bundle' => 'government', 'abbreviation' => '?', 'description'=> 'Unknown'],

  // Legacy/Non-Human
  ['bundle' => 'government', 'abbreviation' => 'G', 'description' => 'Small Station or Facility (Aslan)'],
  ['bundle' => 'government', 'abbreviation' => 'H', 'description' => 'Split Clan Control (Aslan)'],
  ['bundle' => 'government', 'abbreviation' => 'J', 'description' => 'Single On-world Clan Control (Aslan)'],
  ['bundle' => 'government', 'abbreviation' => 'K', 'description' => 'Single Multi-world Clan Control (Aslan)'],
  ['bundle' => 'government', 'abbreviation' => 'L', 'description' => 'Major Clan Control (Aslan)'],
  ['bundle' => 'government', 'abbreviation' => 'M', 'description' => 'Vassal Clan Control (Aslan)'],
  ['bundle' => 'government', 'abbreviation' => 'N', 'description' => 'Major Vassal Clan Control (Aslan)'],
  ['bundle' => 'government', 'abbreviation' => 'P', 'description' => 'Small Station or Facility (K\'Kree)'],
  ['bundle' => 'government', 'abbreviation' => 'Q', 'description' => 'Krurruna or Krumanak Rule for Off-world Steppelord (K\'Kree)'],
  ['bundle' => 'government', 'abbreviation' => 'R', 'description' => 'Steppelord On-world Rule (K\'Kree)'],
  ['bundle' => 'government', 'abbreviation' => 'S', 'description' => 'Sept (Hiver)'],
  ['bundle' => 'government', 'abbreviation' => 'T', 'description' => 'Unsupervised Anarchy (Hiver)'],
  ['bundle' => 'government', 'abbreviation' => 'U', 'description' => 'Supervised Anarchy (Hiver)'],
  ['bundle' => 'government', 'abbreviation' => 'W', 'description' => 'Committee (Hiver)'],
  ['bundle' => 'government', 'abbreviation' => 'X', 'description' => 'Droyne Hierarchy'], // Need a hack for this

];

$data['LAW_TABLE'] = [
  ['bundle' => 'law_level', 'abbreviation' => '0', 'description' => 'No prohibitions'],
  ['bundle' => 'law_level', 'abbreviation' => '1', 'description' => 'Body pistols, explosives, and poison gas prohibited'],
  ['bundle' => 'law_level', 'abbreviation' => '2', 'description' => 'Portable energy weapons prohibited'],
  ['bundle' => 'law_level', 'abbreviation' => '3', 'description' => 'Machine guns, automatic rifles prohibited'],
  ['bundle' => 'law_level', 'abbreviation' => '4', 'description' => 'Light assault weapons prohibited'],
  ['bundle' => 'law_level', 'abbreviation' => '5', 'description' => 'Personal concealable weapons prohibited'],
  ['bundle' => 'law_level', 'abbreviation' => '6', 'description' => 'All firearms except shotguns prohibited'],
  ['bundle' => 'law_level', 'abbreviation' => '7', 'description' => 'Shotguns prohibited'],
  ['bundle' => 'law_level', 'abbreviation' => '8', 'description' => 'Long bladed weapons controlled; open possession prohibited'],
  ['bundle' => 'law_level', 'abbreviation' => '9', 'description' => 'Possession of weapons outside the home prohibited'],
  ['bundle' => 'law_level', 'abbreviation' => 'A', 'description' => 'Weapon possession prohibited'],
  ['bundle' => 'law_level', 'abbreviation' => 'B', 'description' => 'Rigid control of civilian movement'],
  ['bundle' => 'law_level', 'abbreviation' => 'C', 'description' => 'Unrestricted invasion of privacy'],
  ['bundle' => 'law_level', 'abbreviation' => 'D', 'description' => 'Paramilitary law enforcement'],
  ['bundle' => 'law_level', 'abbreviation' => 'E', 'description' => 'Full-fledged police state'],
  ['bundle' => 'law_level', 'abbreviation' => 'F', 'description' => 'All facets of daily life regularly legislated and controlled'],
  ['bundle' => 'law_level', 'abbreviation' => 'G', 'description' => 'Severe punishment for petty infractions'],
  ['bundle' => 'law_level', 'abbreviation' => 'H', 'description' => 'Legalized oppressive practices'],
  ['bundle' => 'law_level', 'abbreviation' => 'J', 'description' => 'Routinely oppressive and restrictive'],
  ['bundle' => 'law_level', 'abbreviation' => 'K', 'description' => 'Excessively oppressive and restrictive'],
  ['bundle' => 'law_level', 'abbreviation' => 'L', 'description' => 'Totally oppressive and restrictive'],
  ['bundle' => 'law_level', 'abbreviation' => 'S', 'description' => 'Special/Variable situation'],
  ['bundle' => 'law_level', 'abbreviation' => 'X', 'description' => 'Unknown'],
  ['bundle' => 'law_level', 'abbreviation' => '?', 'description'=> 'Unknown'],
];

$data['TECH_TABLE'] = [
  ['bundle' => 'tech_level', 'abbreviation' => '0', 'description' => 'Stone Age'],
  ['bundle' => 'tech_level', 'abbreviation' => '1', 'description' => 'Bronze, Iron Age'],
  ['bundle' => 'tech_level', 'abbreviation' => '2', 'description' => 'Printing Press'],
  ['bundle' => 'tech_level', 'abbreviation' => '3', 'description' => 'Basic Science'],
  ['bundle' => 'tech_level', 'abbreviation' => '4', 'description' => 'External Combustion'],
  ['bundle' => 'tech_level', 'abbreviation' => '5', 'description' => 'Mass Production'],
  ['bundle' => 'tech_level', 'abbreviation' => '6', 'description' => 'Nuclear Power'],
  ['bundle' => 'tech_level', 'abbreviation' => '7', 'description' => 'Miniaturized Electronics'],
  ['bundle' => 'tech_level', 'abbreviation' => '8', 'description' => 'Quality Computers'],
  ['bundle' => 'tech_level', 'abbreviation' => '9', 'description' => 'Anti-Gravity'],
  ['bundle' => 'tech_level', 'abbreviation' => 'A', 'description' => 'Interstellar community'],
  ['bundle' => 'tech_level', 'abbreviation' => 'B', 'description' => 'Lower Average Imperial'],
  ['bundle' => 'tech_level', 'abbreviation' => 'C', 'description' => 'Average Imperial'],
  ['bundle' => 'tech_level', 'abbreviation' => 'D', 'description' => 'Above Average Imperial'],
  ['bundle' => 'tech_level', 'abbreviation' => 'E', 'description' => 'Above Average Imperial'],
  ['bundle' => 'tech_level', 'abbreviation' => 'F', 'description' => 'Technical Imperial Maximum'],
  ['bundle' => 'tech_level', 'abbreviation' => 'G', 'description' => 'Robots'],
  ['bundle' => 'tech_level', 'abbreviation' => 'H', 'description' => 'Artificial Intelligence'],
  ['bundle' => 'tech_level', 'abbreviation' => 'J', 'description' => 'Personal Disintegrators'],
  ['bundle' => 'tech_level', 'abbreviation' => 'K', 'description' => 'Plastic Metals'],
  ['bundle' => 'tech_level', 'abbreviation' => 'L', 'description' => 'Comprehensible only as technological magic'],
  ['bundle' => 'tech_level', 'abbreviation' => 'X', 'description' => 'Unknown'],
  ['bundle' => 'tech_level', 'abbreviation' => '?', 'description'=> 'Unknown',] 
];

$data['IX_IMP_TABLE'] = [
  '-3'=> 'Very unimportant',
  '-2'=> 'Very unimportant',
  '-1'=> 'Unimportant',
  '0'=> 'Unimportant',
  '1'=> 'Ordinary',
  '2'=> 'Ordinary',
  '3'=> 'Ordinary',
  '4'=> 'Important',
  '5'=> 'Very important',
  '?'=> 'Unknown'
];

$data['EX_RESOURCES_TABLE'] = [
  '2' => 'Very scarce',
  '3' => 'Very scarce',
  '4' => 'Scarce',
  '5' => 'Scarce',
  '6' => 'Few',
  '7' => 'Few',
  '8' => 'Moderate',
  '9' => 'Moderate',
  'A' => 'Abundant',
  'B' => 'Abundant',
  'C' => 'Very abundant',
  'D' => 'Very abundant',
  'E' => 'Extremely abundant',
  'F' => 'Extremely abundant',
  'G' => 'Extremely abundant',
  'H' => 'Extremely abundant',
  'J' => 'Extremely abundant',
  '?'=> 'Unknown'
];


$data['EX_INFRASTRUCTURE_TABLE'] = [
  '0' => 'Non-existent',
  '1' => 'Extremely limited',
  '2' => 'Extremely limited',
  '3' => 'Very limited',
  '4' => 'Very limited',
  '5' => 'Limited',
  '6' => 'Limited',
  '7' => 'Generally available',
  '8' => 'Generally available',
  '9' => 'Extensive',
  'A' => 'Extensive',
  'B' => 'Very extensive',
  'C' => 'Very extensive',
  'D' => 'Comprehensive',
  'E' => 'Comprehensive',
  'F' => 'Very comprehensive',
  'G' => 'Very comprehensive',
  'H' => 'Very comprehensive',
  '?'=> 'Unknown'
];

$data['EX_EFFICIENCY_TABLE'] = [
  '-5'=> 'Extremely poor',
  '-4'=> 'Very poor',
  '-3'=> 'Poor',
  '-2'=> 'Fair',
  '-1'=> 'Average',
  '0'=> 'Average',
  '+1'=> 'Average',
  '+2'=> 'Good',
  '+3'=> 'Improved',
  '+4'=> 'Advanced',
  '+5'=> 'Very advanced',
  '?'=> 'Unknown'
];

$data['CX_HETEROGENEITY_TABLE'] = [
  '0' => 'N/A',
  '1' => 'Monolithic',
  '2' => 'Monolithic',
  '3' => 'Monolithic',
  '4' => 'Harmonious',
  '5' => 'Harmonious',
  '6' => 'Harmonious',
  '7' => 'Discordant',
  '8' => 'Discordant',
  '9' => 'Discordant',
  'A' => 'Discordant',
  'B' => 'Discordant',
  'C' => 'Fragmented',
  'D' => 'Fragmented',
  'E' => 'Fragmented',
  'F' => 'Fragmented',
  'G' => 'Fragmented',
  '?'=> 'Unknown'
];

$data['CX_ACCEPTANCE_TABLE'] = [
  '0' => 'N/A',
  '1' => 'Extremely xenophobic',
  '2' => 'Very xenophobic',
  '3' => 'Xenophobic',
  '4' => 'Extremely aloof',
  '5' => 'Very aloof',
  '6' => 'Aloof',
  '7' => 'Aloof',
  '8' => 'Friendly',
  '9' => 'Friendly',
  'A' => 'Very friendly',
  'B' => 'Extremely friendly',
  'C' => 'Xenophilic',
  'D' => 'Very Xenophilic',
  'E' => 'Extremely xenophilic',
  'F' => 'Extremely xenophilic',
  '?'=> 'Unknown'
];

$data['CX_STRANGENESS_TABLE'] = [
  '0' => 'N/A',
  '1' => 'Very typical',
  '2' => 'Typical',
  '3' => 'Somewhat typical',
  '4' => 'Somewhat distinct',
  '5' => 'Distinct',
  '6' => 'Very distinct',
  '7' => 'Confusing',
  '8' => 'Very confusing',
  '9' => 'Extremely confusing',
  'A' => 'Incomprehensible',
  '?'=> 'Unknown'
];

$data['CX_SYMBOLS_TABLE'] = [
  '0' => 'Extremely concrete',
  '1' => 'Extremely concrete',
  '2' => 'Very concrete',
  '3' => 'Very concrete',
  '4' => 'Concrete',
  '5' => 'Concrete',
  '6' => 'Somewhat concrete',
  '7' => 'Somewhat concrete',
  '8' => 'Somewhat abstract',
  '9' => 'Somewhat abstract',
  'A' => 'Abstract',
  'B' => 'Abstract',
  'C' => 'Very abstract',
  'D' => 'Very abstract',
  'E' => 'Extremely abstract',
  'F' => 'Extremely abstract',
  'G' => 'Extremely abstract',
  'H' => 'Incomprehensibly abstract',
  'J' => 'Incomprehensibly abstract',
  'K' => 'Incomprehensibly abstract',
  'L' => 'Incomprehensibly abstract',
  '?'=> 'Unknown'
];

$data['NOBILITY_TABLE'] = [
  'B' => 'Knight',
  'c' => 'Baronet',
  'C' => 'Baron',
  'D' => 'Marquis',
  'e' => 'Viscount',
  'E' => 'Count',
  'f' => 'Duke',
  'F' => 'Subsector Duke',
  'G' => 'Archduke',
  'H' => 'Emperor',
  '?'=> 'Unknown'
];

$data['REMARKS_TABLE'] = [

  ['code'=>'As','description' => 'Asteroid Belt', 'extra_info' => 'Siz 0'],
  ['code'=>'De','description' => 'Desert', 'extra_info' => 'Atm 2-9, Hyd 0'],
  ['code'=>'Fl','description' => 'Fluid Hydrographics (in place of water)', 'extra_info' => 'Atm A-C, Hyd 1+'],
  ['code'=>'Ga','description' => 'Garden World', 'extra_info' => 'Siz 6-8, Atm 5,6,8, Hyd 5-7'],
  ['code'=>'He','description' => 'Hellworld', 'extra_info' => 'Siz 3+, Atm 2,4,7,9-C, Hyd 0-2'],
  ['code'=>'Ic','description' => 'Ice Capped', 'extra_info' => 'Atm 0-1, Hyd 1+'],
  ['code'=>'Oc','description' => 'Ocean World', 'extra_info' => 'Siz A+, Hyd A'],
  ['code'=>'Va','description' => 'Vacuum World', 'extra_info' => 'Atm 0'],
  ['code'=>'Wa','description' => 'Water World', 'extra_info' => 'Siz 3-9, Atm 3-9, Hyd A'],


  ['code'=>'Di','description' => 'Dieback', 'extra_info' => 'PGL 0, TL 1+'],
  ['code'=>'Ba','description' => 'Barren', 'extra_info' => 'PGL 0, TL 0'],
  ['code'=>'Lo','description' => 'Low Population', 'extra_info' => 'Pop 1-3'],
  ['code'=>'Ni','description' => 'Non-Industrial', 'extra_info' => 'Pop 4-6'],
  ['code'=>'Ph','description' => 'Pre-High Population', 'extra_info' => 'Pop 8'],
  ['code'=>'Hi','description' => 'High Population', 'extra_info' => 'Pop 9+'],


  ['code'=>'Pa','description' => 'Pre-Agricultural', 'extra_info' => 'Atm 4-9, Hyd 4-8, Pop 4,8'],
  ['code'=>'Ag','description' => 'Agricultural', 'extra_info' => 'Atm 4-9, Hyg 4-8, Pop 5-7'],
  ['code'=>'Na','description' => 'Non-Agricultural', 'extra_info' => 'Atm 3-, Hyd 3-, Pop 6+'],
  ['code'=>'Pi','description' => 'Pre-Industrial', 'extra_info' => 'Atm 0,1,2,4,7,9, Pop 7-8'],
  ['code'=>'In','description' => 'Industrialized', 'extra_info' => 'Atm 0,1,2,4,7,9-C, Pop 9+'],
  ['code'=>'Po','description' => 'Poor', 'extra_info' => 'Atm 2-5, Hyd 3-'],
  ['code'=>'Pr','description' => 'Pre-Rich', 'extra_info' => 'Atm 6,8, Pop 5,9'],
  ['code'=>'Ri','description' => 'Rich', 'extra_info' => 'Atm 6,8, Pop 6-8'],


  ['code'=>'Fr','description' => 'Frozen', 'extra_info' => 'Siz 2-9, Hyd 1+, HZ +2 or Outer'],
  ['code'=>'Ho','description' => 'Hot', 'extra_info' => 'HZ -1'],
  ['code'=>'Co','description' => 'Cold', 'extra_info' => 'HZ +1'],
  ['code'=>'Lk','description' => 'Locked', 'extra_info' => 'Close Satellite'],
  ['code'=>'Tr','description' => 'Tropic', 'extra_info' => 'Siz 6-9, Atm 4-9, Hyd 3-7, HZ -1'],
  ['code'=>'Tu','description' => 'Tundra', 'extra_info' => 'Siz 6-9, Atm 4-9, Hyd 3-7, HZ +1'],
  ['code'=>'Tz','description' => 'Twilight Zone', 'extra_info' => 'Orbit 0-1'],


  ['code'=>'Fa','description' => 'Farming', 'extra_info' => 'Atm 4-9, Hyd 4-8, Pop 2-6, Not Main World, HZ'],
  ['code'=>'Mi','description' => 'Mining', 'extra_info' => 'Pop 2-6, Not Main World, Main World=Industrialized'],
  ['code'=>'Mr','description' => 'Military Rule', 'extra_info' => 'By regional Allegiance power'],
  ['code'=>'Px','description'=>'Prison, Exile Camp', 'extra_info' => 'Main World'],
  ['code'=>'Pe','description' => 'Penal Colony', 'extra_info' => 'Not Main World'],
  ['code'=>'Re','description'=>'Reserve'],


  ['code'=>'Cp','description'=>'Subsector Capital'],
  ['code'=>'Cs','description'=>'Sector Capital'],
  ['code'=>'Cx','description'=>'Capital'],


  ['code'=>'Sa','description'=>'Satellite', 'extra_info' => 'Main World is a moon of a Gas Giant'],
  ['code'=>'Fo','description'=>'Forbidden', 'extra_info' => 'Red Zone'],
  ['code'=>'Pz','description' => 'Puzzle', 'extra_info' => 'Amber Zone, Pop 7+'],
  ['code'=>'Da','description' => 'Danger', 'extra_info' => 'Amber Zone, Pop 6-'],
  ['code'=>'Ab','description'=>'Data Repository'],
  ['code'=>'An','description'=>'Ancient Site'],

  ['code'=>'Rs','description' => 'Research Station', 'extra_info' => 'Imperial'],
  ['code'=>'Nh','description' => 'Non-Hiver Population', 'extra_info' => 'Hiver'],
  ['code'=>'Nk','description'=>'Non-Kkree Population', 'extra_info' => 'K\'kree'],

  ['code'=>'Tp','description' => 'Terra-prime', 'extra_info' => 'Adventure 5: Leviathan'],
  ['code'=>'Tn','description' => 'Terra-norm', 'extra_info' => 'Adventure 5: Leviathan'],
  ['code'=>'Lt','description' => 'Low Technology', 'extra_info' => 'Mongoose Publishing'],
  ['code'=>'Ht','description' => 'High Technology', 'extra_info' => 'Mongoose Publishing'],

  ['code'=>'Fa','description' => 'Fascinating', 'extra_info' => 'Hiver'],
  ['code'=>'St','description' => 'Steppeworld', 'extra_info' => 'K\'kree'],
  ['code'=>'Ex','description' => 'Exile Camp', 'extra_info' => 'Imperial'],
  ['code'=>'Pr','description' => 'Prison World', 'extra_info' => 'Imperial'],
  ['code'=>'Xb','description' => 'Xboat Station', 'extra_info' => 'Imperial'],
  ['code'=>'Cr','description' => 'Reserve Capital', 'extra_info' => 'Zhodani'],

  ['code'=>'RsA', 'description' => 'Research Station Alpha'],
  ['code'=>'RsB', 'description' => 'Research Station Beta'],
  ['code'=>'RsG', 'description' => 'Research Station Gamma'],
  ['code'=>'RsD', 'description' => 'Research Station Delta'],
  ['code'=>'RsE', 'description' => 'Research Station Epsilon'],
  ['code'=>'RsZ', 'description' => 'Research Station Zeta'],
  ['code'=>'RsH', 'description' => 'Research Station Eta'],
  ['code'=>'RsT', 'description' => 'Research Station Theta'],

['code'=>'Cy','description'=>'Colony'],
];

$data['BASE_TABLE'] = [
    'C' => 'Corsair Base',
    'D' => 'Naval Depot',
    'E' => 'Embassy',
    'H' => 'Hiver Supply Base', // For TNE
    'I' => 'Interface', // For TNE
    'K' => 'Naval Base',
    'L' => 'Naval Base', // Obsolete
    'M' => 'Military Base',
    'N' => 'Naval Base',
    'O' => 'Naval Outpost', // Obsolete
    'R' => 'Clan Base',
    'S' => 'Scout Base',
    //    'T' => 'Terminus',   // For TNE - name Collision
    'T' => 'Tlauku Base',
    'V' => 'Exploration Base',
    'W' => 'Way Station',
    'X' => 'Relay Station', // Obsolete
    'Z' => 'Naval/Military Base' // Obsolete
];

// $data['SOPHONT_TABLE'] = [
//   // Legacy codes
//   'A'=> 'Aslan',
//   'C'=> 'Chirper',
//   'D'=> 'Droyne',
//   'F'=> 'Non-Hiver',
//   'H'=> 'Hiver',
//   'I'=> 'Ithklur',
//   'M'=> 'Human',
//   'V'=> 'Vargr',
//   'X'=> 'Addaxur',
//   'Z'=> 'Zhodani'
//   // T5SS codes populated by live data
// ];

$data['STELLAR_TABLE'] = [
  'Ia' => 'Supergiant',
  'Ib' => 'Supergiant',
  'II' => 'Giant',
  'III' => 'Giant',
  'IV' => 'Subgiant',
  'V' => 'Dwarf',
  'D' => 'White Dwarf',
  'BD' => 'Brown Dwarf',
  'BH' => 'Black Hole',
  'PSR' => 'Pulsar',
  'NS' => 'Neutron Star'
];


// $data['REMARKS_PATTERNS'] = [
//   // Special
//   ['pattern' => '/^Rs\w$/', 'comment' => 'Research Station'],
//   ['pattern' => '/^Rw:?\w$/', 'comment' => 'Refugee World'],

//   // Ownership
//   [ 'pattern' => '/^O:\d\d\d\d$/', 'comment' => 'Controlled'],
//   [ 'pattern' => '/^O:\d\d\d\d-\w+$/', 'comment' => 'Controlled'],
//   [ 'pattern' => '/^O:\w\w$/', 'comment' => 'Controlled'],
//   [ 'pattern' => '/^Mr:\d\d\d\d$/', 'comment' => 'Military rule'],

//   // Sophonts
//   [ 'pattern' => '/^\[.*\]\??$/', 'comment' => 'Homeworld'],
//   [ 'pattern' => '/^\(.*\)\??$/', 'comment' => 'Homeworld'],
//   [ 'pattern' => '/^\(.*\)(\d)$/', 'comment' => 'Homeworld, Population $1$`0%'],
//   [ 'pattern' => '/^Di\(.*\)$/', 'comment' => 'Homeworld, Extinct'],
//   [ 'pattern' => "/^([A-Z][A-Za-z']{3})([0-9W?])$/", 'comment' => 'decode sophon population'],
//   [ 'pattern' => '/^([ACDFHIMVXZ])([0-9w])$/', 'comment' => 'decode sophon population'],

//   // Comments
//   [ 'pattern' => '/^\{.*\}$/', 'comment' => '']
// ];

foreach(array_keys($data) as $sectionname){
  file_put_contents('json/' . strtolower($sectionname) . '.json', json_encode($data[$sectionname], JSON_PRETTY_PRINT));
}


// file_put_contents('json/allegiances_table.json', json_encode(json_decode(file_get_contents('https://travellermap.com/t5ss/allegiances')), JSON_PRETTY_PRINT));
// file_put_contents('json/sophonts_table.json', json_encode(json_decode(file_get_contents('https://travellermap.com/t5ss/sophonts')), JSON_PRETTY_PRINT));
// file_put_contents('json/milieux_table.json', json_encode(json_decode(file_get_contents('https://travellermap.com/api/milieux')), JSON_PRETTY_PRINT));

