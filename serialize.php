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
  ['bundle' => 'starport','abbreviation' => 'A', 'short_description' => 'Excellent', 'description' => 'Excellent Quality. Refined fuel available. Annual maintenance overhaul available. Shipyard capable of constructing starships and non-starships present. Naval base and\/or scout base may be present.'],
  ['bundle' => 'starport','abbreviation' => 'B', 'short_description' => 'Good', 'description' => 'Good Quality. Refined fuel available. Annual maintenance overhaul available. Shipyard capable of constructing non-starships present. Naval base and\/or scout base may be present.'],
  ['bundle' => 'starport','abbreviation' => 'C', 'short_description' => 'Routine', 'description' => 'Routine Quality. Only unrefined fuel available. Reasonable repair facilities present. Scout base may be present.'],
  ['bundle' => 'starport','abbreviation' => 'D', 'short_description' => 'Poor', 'description' => 'Poor Quality. Only unrefined fuel available. No repair facilities present. Scout base may be present.'],
  ['bundle' => 'starport','abbreviation' => 'E', 'short_description' => 'Frontier Installation', 'description' => 'Frontier Installation. Essentially a marked spot of bedrock with no fuel, facilities, or bases present.'],
  ['bundle' => 'starport','abbreviation' => 'X', 'short_description' => 'None or Unknown', 'description' => 'No Starport. No provision is made for any ship landings.'],
  ['bundle' => 'starport','abbreviation' => 'F', 'short_description' => 'Good', 'description' => '(Spaceport) Good Quality. Minor damage repairable. Unrefined fuel available.'],
  ['bundle' => 'starport','abbreviation' => 'G', 'short_description' => 'Poor', 'description' => '(Spaceport) Poor Quality. Limited repair capability. Only unrefined fuel available.'],
  ['bundle' => 'starport','abbreviation' => 'H', 'short_description' => 'Primitive', 'description' => '(Spaceport) Primitive. No repair capability. No repairs available.'],
  ['bundle' => 'starport','abbreviation' => 'Y', 'short_description' => 'None', 'description' => 'No Starport. No provision is made for any ship landings.'],
  ['bundle' => 'starport','abbreviation' => '?', 'short_description'=> 'Unknown', 'description' => 'No information or starport classification found.']
];

$data['SIZ_TABLE'] = [
  ['bundle'=> 'world_size', 'abbreviation'=>'0', 'short_description' => 'Asteroid Belt'],
  ['bundle'=> 'world_size', 'abbreviation'=>'S', 'short_description' => 'Small World'],
  ['bundle'=> 'world_size', 'abbreviation'=>'1', 'short_description' => '1,600km (0.12g)', 'extra_data' => ['diameter' => 1600, 'mass' => 0.0019, 'area'=> 0.015, 'gravity' => 0.122, 'esc_velocity' => 1.35]],
  ['bundle'=> 'world_size', 'abbreviation'=>'2', 'short_description' => '3,200km (0.25g)', 'extra_data' => ['diameter' => 3200, 'mass' => 0.015, 'area'=> 0.063, 'gravity' => 0.240, 'esc_velocity' => 2.69]],
  ['bundle'=> 'world_size', 'abbreviation'=>'3', 'short_description' => '4,800km (0.38g)', 'extra_data' => ['diameter' => 4800, 'mass' => 0.053, 'area'=> 0.141, 'gravity' => 0.377, 'esc_velocity' => 4.13]],
  ['bundle'=> 'world_size', 'abbreviation'=>'4', 'short_description' => '6,400km (0.50g)', 'extra_data' => ['diameter' => 6400, 'mass' => 0.125, 'area'=> 0.250, 'gravity' => 0.500, 'esc_velocity' => 5.49]],
  ['bundle'=> 'world_size', 'abbreviation'=>'5', 'short_description' => '8,000km (0.63g)', 'extra_data' => ['diameter' => 8000, 'mass' => 0.244, 'area'=> 0.391, 'gravity' => 0.625, 'esc_velocity' => 6.87]],
  ['bundle'=> 'world_size', 'abbreviation'=>'6', 'short_description' => '9,600km (0.75g)', 'extra_data' => ['diameter' => 9600, 'mass' => 0.422, 'area'=> 0.563, 'gravity' => 0.840, 'esc_velocity' => 8.72]],
  ['bundle'=> 'world_size', 'abbreviation'=>'7', 'short_description' => '11,200km (0.88g)', 'extra_data' => ['diameter' => 11200, 'mass' => 0.670, 'area'=> 0.766, 'gravity' => 0.875, 'esc_velocity' => 9.62]],
  ['bundle'=> 'world_size', 'abbreviation'=>'8', 'short_description' => '12,800km (1.0g)', 'extra_data' => ['diameter' => 12800, 'mass' => 1.000, 'area'=> 1.000, 'gravity' => 1.000, 'esc_velocity' => 11.00]],
  ['bundle'=> 'world_size', 'abbreviation'=>'9', 'short_description' => '14,400km (1.12g)', 'extra_data' => ['diameter' => 14400, 'mass' => 1.424, 'area'=> 1.266, 'gravity' => 1.120, 'esc_velocity' => 12.35]],
  ['bundle'=> 'world_size', 'abbreviation'=>'A', 'short_description' => '16,000km (1.25g)', 'extra_data' => ['diameter' => 16000, 'mass' => 1.953, 'area'=> 1.563, 'gravity' => 1.250, 'esc_velocity' => 13.73]],
  ['bundle'=> 'world_size', 'abbreviation'=>'B', 'short_description' => '17,600km (1.38g)', 'extra_data' => ['diameter' => 18800, 'mass' => 2.600, 'area'=> 1.891, 'gravity' => 1.375, 'esc_velocity' => 15.34]],
  ['bundle'=> 'world_size', 'abbreviation'=>'C', 'short_description' => '19,200km (1.50g)', 'extra_data' => ['diameter' => 19200, 'mass' => 3.375, 'area'=> 2.250, 'gravity' => 1.500, 'esc_velocity' => 16.74]],
  ['bundle'=> 'world_size', 'abbreviation'=>'D', 'short_description' => '20,800km (1.63g)', 'extra_data' => ['diameter' => 20800, 'mass' => 4.291, 'area'=> 2.641, 'gravity' => 1.625, 'esc_velocity' => 18.13]],
  ['bundle'=> 'world_size', 'abbreviation'=>'E', 'short_description' => '22,400km (1.75g)', 'extra_data' => ['diameter' => 22400, 'mass' => 5.359, 'area'=> 3.063, 'gravity' => 1.750, 'esc_velocity' => 19.52]],
  ['bundle'=> 'world_size', 'abbreviation'=>'F', 'short_description' => '24,000km (2.0g)', 'extra_data' => ['diameter' => 24000, 'mass' => 6.592, 'area'=> 3.516, 'gravity' => 1.875, 'esc_velocity' => 20.92]],
  ['bundle'=> 'world_size', 'abbreviation'=>'X', 'short_description' => 'Unknown'],
  ['bundle'=> 'world_size', 'abbreviation'=>'?', 'short_description'=> 'Unknown'],
];

$data['ATM_TABLE'] = [
  ['bundle' => 'atmosphere', 'abbreviation' => '0', 'short_description' => 'No atmosphere'],
  ['bundle' => 'atmosphere', 'abbreviation' => '1', 'short_description' => 'Trace'],
  ['bundle' => 'atmosphere', 'abbreviation' => '2', 'short_description' => 'Very thin; Tainted'],
  ['bundle' => 'atmosphere', 'abbreviation' => '3', 'short_description' => 'Very thin'],
  ['bundle' => 'atmosphere', 'abbreviation' => '4', 'short_description' => 'Thin; Tainted'],
  ['bundle' => 'atmosphere', 'abbreviation' => '5', 'short_description' => 'Thin'],
  ['bundle' => 'atmosphere', 'abbreviation' => '6', 'short_description' => 'Standard'],
  ['bundle' => 'atmosphere', 'abbreviation' => '7', 'short_description' => 'Standard; Tainted'],
  ['bundle' => 'atmosphere', 'abbreviation' => '8', 'short_description' => 'Dense'],
  ['bundle' => 'atmosphere', 'abbreviation' => '9', 'short_description' => 'Dense; Tainted'],
  ['bundle' => 'atmosphere', 'abbreviation' => 'A', 'short_description' => 'Exotic'],
  ['bundle' => 'atmosphere', 'abbreviation' => 'B', 'short_description' => 'Corrosive'],
  ['bundle' => 'atmosphere', 'abbreviation' => 'C', 'short_description' => 'Insidious'],
  ['bundle' => 'atmosphere', 'abbreviation' => 'D', 'short_description' => 'Dense, high'],
  ['bundle' => 'atmosphere', 'abbreviation' => 'E', 'short_description' => 'Thin, low'],
  ['bundle' => 'atmosphere', 'abbreviation' => 'F', 'short_description' => 'Unusual'],
  ['bundle' => 'atmosphere', 'abbreviation' => 'X', 'short_description' => 'Unknown'],
  ['bundle' => 'atmosphere', 'abbreviation' => '?', 'short_description'=> 'Unknown'],
];

$data['HYD_TABLE'] = [
  ['bundle' => 'hydrographics', 'abbreviation' => '0', 'short_description' => 'Desert World'],
  ['bundle' => 'hydrographics', 'abbreviation' => '1', 'short_description' => '10%'],
  ['bundle' => 'hydrographics', 'abbreviation' => '2', 'short_description' => '20%'],
  ['bundle' => 'hydrographics', 'abbreviation' => '3', 'short_description' => '30%'],
  ['bundle' => 'hydrographics', 'abbreviation' => '4', 'short_description' => '40%'],
  ['bundle' => 'hydrographics', 'abbreviation' => '5', 'short_description' => '50%'],
  ['bundle' => 'hydrographics', 'abbreviation' => '6', 'short_description' => '60%'],
  ['bundle' => 'hydrographics', 'abbreviation' => '7', 'short_description' => '70%'],
  ['bundle' => 'hydrographics', 'abbreviation' => '8', 'short_description' => '80%'],
  ['bundle' => 'hydrographics', 'abbreviation' => '9', 'short_description' => '90%'],
  ['bundle' => 'hydrographics', 'abbreviation' => 'A', 'short_description' => 'Water World'],
  ['bundle' => 'hydrographics', 'abbreviation' => 'X', 'short_description' => 'Unknown'],
  ['bundle' => 'hydrographics', 'abbreviation' => '?', 'short_description'=> 'Unknown'],
];

$data['POP_TABLE'] = [
  ['bundle' => 'population_exponent', 'abbreviation' => '0', 'short_description' => 'Unpopulated'],
  ['bundle' => 'population_exponent', 'abbreviation' => '1', 'short_description' => 'Tens'],
  ['bundle' => 'population_exponent', 'abbreviation' => '2', 'short_description' => 'Hundreds'],
  ['bundle' => 'population_exponent', 'abbreviation' => '3', 'short_description' => 'Thousands'],
  ['bundle' => 'population_exponent', 'abbreviation' => '4', 'short_description' => 'Tens of thousands'],
  ['bundle' => 'population_exponent', 'abbreviation' => '5', 'short_description' => 'Hundreds of thousands'],
  ['bundle' => 'population_exponent', 'abbreviation' => '6', 'short_description' => 'Millions'],
  ['bundle' => 'population_exponent', 'abbreviation' => '7', 'short_description' => 'Tens of millions'],
  ['bundle' => 'population_exponent', 'abbreviation' => '8', 'short_description' => 'Hundreds of millions'],
  ['bundle' => 'population_exponent', 'abbreviation' => '9', 'short_description' => 'Billions'],
  ['bundle' => 'population_exponent', 'abbreviation' => 'A', 'short_description' => 'Tens of billions'],
  ['bundle' => 'population_exponent', 'abbreviation' => 'B', 'short_description' => 'Hundreds of billions'],
  ['bundle' => 'population_exponent', 'abbreviation' => 'C', 'short_description' => 'Trillions'],
  ['bundle' => 'population_exponent', 'abbreviation' => 'D', 'short_description' => 'Tens of trillions'],
  ['bundle' => 'population_exponent', 'abbreviation' => 'E', 'short_description' => 'Hundreds of tillions'],
  ['bundle' => 'population_exponent', 'abbreviation' => 'F', 'short_description' => 'Quadrillions'],
  ['bundle' => 'population_exponent', 'abbreviation' => 'X', 'short_description' => 'Unknown'],
  ['bundle' => 'population_exponent', 'abbreviation' => '?', 'short_description'=> 'Unknown'],
];

$data['GOV_TABLE'] = [
  ['bundle' => 'government', 'abbreviation' => '0', 'short_description' => 'No Government Structure'],
  ['bundle' => 'government', 'abbreviation' => '1', 'short_description' => 'Company/Corporation'],
  ['bundle' => 'government', 'abbreviation' => '2', 'short_description' => 'Participating Democracy'],
  ['bundle' => 'government', 'abbreviation' => '3', 'short_description' => 'Self-Perpetuating Oligarchy'],
  ['bundle' => 'government', 'abbreviation' => '4', 'short_description' => 'Representative Democracy'],
  ['bundle' => 'government', 'abbreviation' => '5', 'short_description' => 'Feudal Technocracy'],
  ['bundle' => 'government', 'abbreviation' => '6', 'short_description' => 'Captive Government / Colony'],
  ['bundle' => 'government', 'abbreviation' => '7', 'short_description' => 'Balkanization'],
  ['bundle' => 'government', 'abbreviation' => '8', 'short_description' => 'Civil Service Bureaucracy'],
  ['bundle' => 'government', 'abbreviation' => '9', 'short_description' => 'Impersonal Bureaucracy'],
  ['bundle' => 'government', 'abbreviation' => 'A', 'short_description' => 'Charismatic Dictator'],
  ['bundle' => 'government', 'abbreviation' => 'B', 'short_description' => 'Non-Charismatic Dictator'],
  ['bundle' => 'government', 'abbreviation' => 'C', 'short_description' => 'Charismatic Oligarchy'],
  ['bundle' => 'government', 'abbreviation' => 'D', 'short_description' => 'Religious Dictatorship'],
  ['bundle' => 'government', 'abbreviation' => 'E', 'short_description' => 'Religious Autocracy'],
  ['bundle' => 'government', 'abbreviation' => 'F', 'short_description' => 'Totalitarian Oligarchy'],
  ['bundle' => 'government', 'abbreviation' => 'X', 'short_description' => 'Unknown'],
  ['bundle' => 'government', 'abbreviation' => '?', 'short_description'=> 'Unknown'],

  // Legacy/Non-Human
  ['bundle' => 'government', 'abbreviation' => 'G', 'short_description' => 'Small Station or Facility (Aslan)'],
  ['bundle' => 'government', 'abbreviation' => 'H', 'short_description' => 'Split Clan Control (Aslan)'],
  ['bundle' => 'government', 'abbreviation' => 'J', 'short_description' => 'Single On-world Clan Control (Aslan)'],
  ['bundle' => 'government', 'abbreviation' => 'K', 'short_description' => 'Single Multi-world Clan Control (Aslan)'],
  ['bundle' => 'government', 'abbreviation' => 'L', 'short_description' => 'Major Clan Control (Aslan)'],
  ['bundle' => 'government', 'abbreviation' => 'M', 'short_description' => 'Vassal Clan Control (Aslan)'],
  ['bundle' => 'government', 'abbreviation' => 'N', 'short_description' => 'Major Vassal Clan Control (Aslan)'],
  ['bundle' => 'government', 'abbreviation' => 'P', 'short_description' => 'Small Station or Facility (K\'Kree)'],
  ['bundle' => 'government', 'abbreviation' => 'Q', 'short_description' => 'Krurruna or Krumanak Rule for Off-world Steppelord (K\'Kree)'],
  ['bundle' => 'government', 'abbreviation' => 'R', 'short_description' => 'Steppelord On-world Rule (K\'Kree)'],
  ['bundle' => 'government', 'abbreviation' => 'S', 'short_description' => 'Sept (Hiver)'],
  ['bundle' => 'government', 'abbreviation' => 'T', 'short_description' => 'Unsupervised Anarchy (Hiver)'],
  ['bundle' => 'government', 'abbreviation' => 'U', 'short_description' => 'Supervised Anarchy (Hiver)'],
  ['bundle' => 'government', 'abbreviation' => 'W', 'short_description' => 'Committee (Hiver)'],
  ['bundle' => 'government', 'abbreviation' => 'X', 'short_description' => 'Droyne Hierarchy'], // Need a hack for this

];

$data['LAW_TABLE'] = [
  ['bundle' => 'law_level', 'abbreviation' => '0', 'short_description' => 'No prohibitions'],
  ['bundle' => 'law_level', 'abbreviation' => '1', 'short_description' => 'Body pistols, explosives, and poison gas prohibited'],
  ['bundle' => 'law_level', 'abbreviation' => '2', 'short_description' => 'Portable energy weapons prohibited'],
  ['bundle' => 'law_level', 'abbreviation' => '3', 'short_description' => 'Machine guns, automatic rifles prohibited'],
  ['bundle' => 'law_level', 'abbreviation' => '4', 'short_description' => 'Light assault weapons prohibited'],
  ['bundle' => 'law_level', 'abbreviation' => '5', 'short_description' => 'Personal concealable weapons prohibited'],
  ['bundle' => 'law_level', 'abbreviation' => '6', 'short_description' => 'All firearms except shotguns prohibited'],
  ['bundle' => 'law_level', 'abbreviation' => '7', 'short_description' => 'Shotguns prohibited'],
  ['bundle' => 'law_level', 'abbreviation' => '8', 'short_description' => 'Long bladed weapons controlled; open possession prohibited'],
  ['bundle' => 'law_level', 'abbreviation' => '9', 'short_description' => 'Possession of weapons outside the home prohibited'],
  ['bundle' => 'law_level', 'abbreviation' => 'A', 'short_description' => 'Weapon possession prohibited'],
  ['bundle' => 'law_level', 'abbreviation' => 'B', 'short_description' => 'Rigid control of civilian movement'],
  ['bundle' => 'law_level', 'abbreviation' => 'C', 'short_description' => 'Unrestricted invasion of privacy'],
  ['bundle' => 'law_level', 'abbreviation' => 'D', 'short_description' => 'Paramilitary law enforcement'],
  ['bundle' => 'law_level', 'abbreviation' => 'E', 'short_description' => 'Full-fledged police state'],
  ['bundle' => 'law_level', 'abbreviation' => 'F', 'short_description' => 'All facets of daily life regularly legislated and controlled'],
  ['bundle' => 'law_level', 'abbreviation' => 'G', 'short_description' => 'Severe punishment for petty infractions'],
  ['bundle' => 'law_level', 'abbreviation' => 'H', 'short_description' => 'Legalized oppressive practices'],
  ['bundle' => 'law_level', 'abbreviation' => 'J', 'short_description' => 'Routinely oppressive and restrictive'],
  ['bundle' => 'law_level', 'abbreviation' => 'K', 'short_description' => 'Excessively oppressive and restrictive'],
  ['bundle' => 'law_level', 'abbreviation' => 'L', 'short_description' => 'Totally oppressive and restrictive'],
  ['bundle' => 'law_level', 'abbreviation' => 'S', 'short_description' => 'Special/Variable situation'],
  ['bundle' => 'law_level', 'abbreviation' => 'X', 'short_description' => 'Unknown'],
  ['bundle' => 'law_level', 'abbreviation' => '?', 'short_description'=> 'Unknown'],
];

$data['TECH_TABLE'] = [
  '0' => 'Stone Age',
  '1' => 'Bronze, Iron Age',
  '2' => 'Printing Press',
  '3' => 'Basic Science',
  '4' => 'External Combustion',
  '5' => 'Mass Production',
  '6' => 'Nuclear Power',
  '7' => 'Miniaturized Electronics',
  '8' => 'Quality Computers',
  '9' => 'Anti-Gravity',
  'A' => 'Interstellar community',
  'B' => 'Lower Average Imperial',
  'C' => 'Average Imperial',
  'D' => 'Above Average Imperial',
  'E' => 'Above Average Imperial',
  'F' => 'Technical Imperial Maximum',
  'G' => 'Robots',
  'H' => 'Artificial Intelligence',
  'J' => 'Personal Disintegrators',
  'K' => 'Plastic Metals',
  'L' => 'Comprehensible only as technological magic',
  'X' => 'Unknown',
  '?'=> 'Unknown'
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
  // Planetary
  'As' => 'Asteroid Belt',
  'De' => 'Desert',
  'Fl' => 'Fluid Hydrographics (in place of water)',
  'Ga' => 'Garden World',
  'He' => 'Hellworld',
  'Ic' => 'Ice Capped',
  'Oc' => 'Ocean World',
  'Va' => 'Vacuum World',
  'Wa' => 'Water World',

  // Population
  'Di' => 'Dieback',
  'Ba' => 'Barren',
  'Lo' => 'Low Population',
  'Ni' => 'Non-Industrial',
  'Ph' => 'Pre-High Population',
  'Hi' => 'High Population',

  // Economic
  'Pa' => 'Pre-Agricultural',
  'Ag' => 'Agricultural',
  'Na' => 'Non-Agricultural',
  'Px' => 'Prison, Exile Camp',
  'Pi' => 'Pre-Industrial',
  'In' => 'Industrialized',
  'Po' => 'Poor',
  'Pr' => 'Pre-Rich',
  'Ri' => 'Rich',

  // Climate
  'Fr' => 'Frozen',
  'Ho' => 'Hot',
  'Co' => 'Cold',
  'Lk' => 'Locked',
  'Tr' => 'Tropic',
  'Tu' => 'Tundra',
  'Tz' => 'Twilight Zone',

  // Secondary
  'Fa' => 'Farming',
  'Mi' => 'Mining',
  'Mr' => 'Military Rule',
  'Pe' => 'Penal Colony',
  'Re' => 'Reserve',

  // Political
  'Cp' => 'Subsector Capital',
  'Cs' => 'Sector Capital',
  'Cx' => 'Capital',
  'Cy' => 'Colony',

  // Special
  'Sa' => 'Satellite',
  'Fo' => 'Forbidden',
  'Pz' => 'Puzzle',
  'Da' => 'Danger',
  'Ab' => 'Data Repository',
  'An' => 'Ancient Site',

  'Rs' => 'Research Station',
  'RsA' => 'Research Station Alpha',
  'RsB' => 'Research Station Beta',
  'RsG' => 'Research Station Gamma',
  'RsD' => 'Research Station Delta',
  'RsE' => 'Research Station Epsilon',
  'RsZ' => 'Research Station Zeta',
  'RsH' => 'Research Station Eta',
  'RsT' => 'Research Station Theta',

  // Legacy
  'Nh' => 'Non-Hiver Population',
  'Nk' => "Non-K'kree Population",
  'Tp' => 'Terra-prime',
  'Tn' => 'Terra-norm',
  'Lt' => 'Low Technology',
  'Ht' => 'High Technology',
  //'Fa' => 'Fascinating', // Conflicts with 'T5' => Farming.
  'St' => 'Steppeworld',
  'Ex' => 'Exile Camp',
  //'Pr' => 'Prison World', // Conflicts with 'T5' => Pre-Rich.
  'Xb' => 'Xboat Station',
  'Cr' => 'Reserve Capital'
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

