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





$data['STARPORT_TABLE'] = [
  // Starports
  'A' => 'Excellent',
  'B' => 'Good',
  'C' => 'Routine',
  'D' => 'Poor',
  'E' => 'Frontier Installation',
  'X' => 'None or Unknown',
  // Spaceports
  'F' => 'Good',
  'G' => 'Poor',
  'H' => 'Primitive',
  'Y' => 'None',
  '?'=> 'Unknown'
];

$data['SIZ_TABLE'] = [
  '0' => 'Asteroid Belt',
  'S' => 'Small World', // MegaTraveller
  '1' => '1,600km (0.12g)',
  '2' => '3,200km (0.25g)',
  '3' => '4,800km (0.38g)',
  '4' => '6,400km (0.50g)',
  '5' => '8,000km (0.63g)',
  '6' => '9,600km (0.75g)',
  '7' => '11,200km (0.88g)',
  '8' => '12,800km (1.0g)',
  '9' => '14,400km (1.12g)',
  'A' => '16,000km (1.25g)',
  'B' => '17,600km (1.38g)',
  'C' => '19,200km (1.50g)',
  'D' => '20,800km (1.63g)',
  'E' => '22,400km (1.75g)',
  'F' => '24,000km (2.0g)',
  'X' => 'Unknown',
  '?'=> 'Unknown'
];

$data['ATM_TABLE'] = [
  '0' => 'No atmosphere',
  '1' => 'Trace',
  '2' => 'Very thin; Tainted',
  '3' => 'Very thin',
  '4' => 'Thin; Tainted',
  '5' => 'Thin',
  '6' => 'Standard',
  '7' => 'Standard; Tainted',
  '8' => 'Dense',
  '9' => 'Dense; Tainted',
  'A' => 'Exotic',
  'B' => 'Corrosive',
  'C' => 'Insidious',
  'D' => 'Dense, high',
  'E' => 'Thin, low',
  'F' => 'Unusual',
  'X' => 'Unknown',
  '?'=> 'Unknown'
];

$data['HYD_TABLE'] = [
  '0' => 'Desert World',
  '1' => '10%',
  '2' => '20%',
  '3' => '30%',
  '4' => '40%',
  '5' => '50%',
  '6' => '60%',
  '7' => '70%',
  '8' => '80%',
  '9' => '90%',
  'A' => 'Water World',
  'X' => 'Unknown',
  '?'=> 'Unknown'
];

$data['POP_TABLE'] = [
  '0' => 'Unpopulated',
  '1' => 'Tens',
  '2' => 'Hundreds',
  '3' => 'Thousands',
  '4' => 'Tens of thousands',
  '5' => 'Hundreds of thousands',
  '6' => 'Millions',
  '7' => 'Tens of millions',
  '8' => 'Hundreds of millions',
  '9' => 'Billions',
  'A' => 'Tens of billions',
  'B' => 'Hundreds of billions',
  'C' => 'Trillions',
  'D' => 'Tens of trillions',
  'E' => 'Hundreds of tillions',
  'F' => 'Quadrillions',
  'X' => 'Unknown',
  '?'=> 'Unknown'
];

$data['GOV_TABLE'] = [
  '0' => 'No Government Structure',
  '1' => 'Company/Corporation',
  '2' => 'Participating Democracy',
  '3' => 'Self-Perpetuating Oligarchy',
  '4' => 'Representative Democracy',
  '5' => 'Feudal Technocracy',
  '6' => 'Captive Government / Colony',
  '7' => 'Balkanization',
  '8' => 'Civil Service Bureaucracy',
  '9' => 'Impersonal Bureaucracy',
  'A' => 'Charismatic Dictator',
  'B' => 'Non-Charismatic Dictator',
  'C' => 'Charismatic Oligarchy',
  'D' => 'Religious Dictatorship',
  'E' => 'Religious Autocracy',
  'F' => 'Totalitarian Oligarchy',
  'X' => 'Unknown',
  '?'=> 'Unknown',

  // Legacy/Non-Human
  'G' => 'Small Station or Facility',
  'H' => 'Split Clan Control',
  'J' => 'Single On-world Clan Control',
  'K' => 'Single Multi-world Clan Control',
  'L' => 'Major Clan Control',
  'M' => 'Vassal Clan Control',
  'N' => 'Major Vassal Clan Control',
  'P' => 'Small Station or Facility',
  'Q' => 'Krurruna or Krumanak Rule for Off-world Steppelord',
  'R' => 'Steppelord On-world Rule',
  'S' => 'Sept',
  'T' => 'Unsupervised Anarchy',
  'U' => 'Supervised Anarchy',
  'W' => 'Committee'
  //'X' => 'Droyne Hierarchy' // Need a hack for this

];

$data['LAW_TABLE'] = [
  '0' => 'No prohibitions',
  '1' => 'Body pistols, explosives, and poison gas prohibited',
  '2' => 'Portable energy weapons prohibited',
  '3' => 'Machine guns, automatic rifles prohibited',
  '4' => 'Light assault weapons prohibited',
  '5' => 'Personal concealable weapons prohibited',
  '6' => 'All firearms except shotguns prohibited',
  '7' => 'Shotguns prohibited',
  '8' => 'Long bladed weapons controlled; open possession prohibited',
  '9' => 'Possession of weapons outside the home prohibited',
  'A' => 'Weapon possession prohibited',
  'B' => 'Rigid control of civilian movement',
  'C' => 'Unrestricted invasion of privacy',
  'D' => 'Paramilitary law enforcement',
  'E' => 'Full-fledged police state',
  'F' => 'All facets of daily life regularly legislated and controlled',
  'G' => 'Severe punishment for petty infractions',
  'H' => 'Legalized oppressive practices',
  'J' => 'Routinely oppressive and restrictive',
  'K' => 'Excessively oppressive and restrictive',
  'L' => 'Totally oppressive and restrictive',
  'S' => 'Special/Variable situation',
  'X' => 'Unknown',
  '?'=> 'Unknown'
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

$data['SOPHONT_TABLE'] = [
  // Legacy codes
  'A'=> 'Aslan',
  'C'=> 'Chirper',
  'D'=> 'Droyne',
  'F'=> 'Non-Hiver',
  'H'=> 'Hiver',
  'I'=> 'Ithklur',
  'M'=> 'Human',
  'V'=> 'Vargr',
  'X'=> 'Addaxur',
  'Z'=> 'Zhodani'
  // T5SS codes populated by live data
];

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


$data['REMARKS_PATTERNS'] = [
  // Special
  ['pattern' => '/^Rs\w$/', 'comment' => 'Research Station'],
  ['pattern' => '/^Rw:?\w$/', 'comment' => 'Refugee World'],

  // Ownership
  [ 'pattern' => '/^O:\d\d\d\d$/', 'comment' => 'Controlled'],
  [ 'pattern' => '/^O:\d\d\d\d-\w+$/', 'comment' => 'Controlled'],
  [ 'pattern' => '/^O:\w\w$/', 'comment' => 'Controlled'],
  [ 'pattern' => '/^Mr:\d\d\d\d$/', 'comment' => 'Military rule'],

  // Sophonts
  [ 'pattern' => '/^\[.*\]\??$/', 'comment' => 'Homeworld'],
  [ 'pattern' => '/^\(.*\)\??$/', 'comment' => 'Homeworld'],
  [ 'pattern' => '/^\(.*\)(\d)$/', 'comment' => 'Homeworld, Population $1$`0%'],
  [ 'pattern' => '/^Di\(.*\)$/', 'comment' => 'Homeworld, Extinct'],
  [ 'pattern' => "/^([A-Z][A-Za-z']{3})([0-9W?])$/", 'comment' => 'decode sophon population'],
  [ 'pattern' => '/^([ACDFHIMVXZ])([0-9w])$/', 'comment' => 'decode sophon population'],

  // Comments
  [ 'pattern' => '/^\{.*\}$/', 'comment' => '']
];

foreach(array_keys($data) as $sectionname){
  file_put_contents('json/' . strtolower($sectionname) . '.json', json_encode($data[$sectionname], JSON_PRETTY_PRINT));
}


// file_put_contents('json/allegiances_table.json', json_encode(json_decode(file_get_contents('https://travellermap.com/t5ss/allegiances')), JSON_PRETTY_PRINT));
// file_put_contents('json/sophonts_table.json', json_encode(json_decode(file_get_contents('https://travellermap.com/t5ss/sophonts')), JSON_PRETTY_PRINT));
// file_put_contents('json/milieux_table.json', json_encode(json_decode(file_get_contents('https://travellermap.com/api/milieux')), JSON_PRETTY_PRINT));

*/