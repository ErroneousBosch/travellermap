<?php

// use App\Kernel;


// require_once __DIR__.'/vendor/autoload_runtime.php';


// $kernel = new Kernel('dev', true);
// $kernel->boot();
// $container = $kernel->getContainer();
// $api = $container->get('App\Service\TravellerMapApi');
 
// $adat = $api->getAllegiances();
// var_dump($adat);
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
  $data += $data[$sectionname] ?? [];
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
$remarks = [

  ['code' =>'As','description' => 'Asteroid Belt', 'extra_info' => 'Siz 0'],
  ['code' =>'De','description' => 'Desert', 'extra_info' => 'Atm 2-9, Hyd 0'],
  ['code' =>'Fl','description' => 'Fluid Hydrographics (in place of water)', 'extra_info' => 'Atm A-C, Hyd 1+'],
  ['code' =>'Ga','description' => 'Garden World', 'extra_info' => 'Siz 6-8, Atm 5,6,8, Hyd 5-7'],
  ['code' =>'He','description' => 'Hellworld', 'extra_info' => 'Siz 3+, Atm 2,4,7,9-C, Hyd 0-2'],
  ['code' =>'Ic','description' => 'Ice Capped', 'extra_info' => 'Atm 0-1, Hyd 1+'],
  ['code' =>'Oc','description' => 'Ocean World', 'extra_info' => 'Siz A+, Hyd A'],
  ['code' =>'Va','description' => 'Vacuum World', 'extra_info' => 'Atm 0'],
  ['code' =>'Wa','description' => 'Water World', 'extra_info' => 'Siz 3-9, Atm 3-9, Hyd A'],


  ['code' =>'Di','description' => 'Dieback', 'extra_info' => 'PGL 0, TL 1+'],
  ['code' =>'Ba','description' => 'Barren', 'extra_info' => 'PGL 0, TL 0'],
  ['code' =>'Lo','description' => 'Low Population', 'extra_info' => 'Pop 1-3'],
  ['code' =>'Ni','description' => 'Non-Industrial', 'extra_info' => 'Pop 4-6'],
  ['code' =>'Ph','description' => 'Pre-High Population', 'extra_info' => 'Pop 8'],
  ['code' =>'Hi','description' => 'High Population', 'extra_info' => 'Pop 9+'],


  ['code' =>'Pa','description' => 'Pre-Agricultural', 'extra_info' => 'Atm 4-9, Hyd 4-8, Pop 4,8'],
  ['code' =>'Ag','description' => 'Agricultural', 'extra_info' => 'Atm 4-9, Hyg 4-8, Pop 5-7'],
  ['code' =>'Na','description' => 'Non-Agricultural', 'extra_info' => 'Atm 3-, Hyd 3-, Pop 6+'],
  ['code' =>'Pi','description' => 'Pre-Industrial', 'extra_info' => 'Atm 0,1,2,4,7,9, Pop 7-8'],
  ['code' =>'In','description' => 'Industrialized', 'extra_info' => 'Atm 0,1,2,4,7,9-C, Pop 9+'],
  ['code' =>'Po','description' => 'Poor', 'extra_info' => 'Atm 2-5, Hyd 3-'],
  ['code' =>'Pr','description' => 'Pre-Rich', 'extra_info' => 'Atm 6,8, Pop 5,9'],
  ['code' =>'Ri','description' => 'Rich', 'extra_info' => 'Atm 6,8, Pop 6-8'],
  ['code' =>'Fr','description' => 'Frozen', 'extra_info' => 'Siz 2-9, Hyd 1+, HZ +2 or Outer'],
  ['code' =>'Ho','description' => 'Hot', 'extra_info' => 'HZ -1'],
  ['code' =>'Co','description' => 'Cold', 'extra_info' => 'HZ +1'],
  ['code' =>'Lk','description' => 'Locked', 'extra_info' => 'Close Satellite'],
  ['code' =>'Tr','description' => 'Tropic', 'extra_info' => 'Siz 6-9, Atm 4-9, Hyd 3-7, HZ -1'],
  ['code' =>'Tu','description' => 'Tundra', 'extra_info' => 'Siz 6-9, Atm 4-9, Hyd 3-7, HZ +1'],
  ['code' =>'Tz','description' => 'Twilight Zone', 'extra_info' => 'Orbit 0-1'],
  ['code' =>'Fa','description' => 'Farming', 'extra_info' => 'Atm 4-9, Hyd 4-8, Pop 2-6, Not Main World, HZ'],
  ['code' =>'Mi','description' => 'Mining', 'extra_info' => 'Pop 2-6, Not Main World, Main World=Industrialized'],
  ['code' =>'Mr','description' => 'Military Rule', 'extra_info' => 'By regional Allegiance power'],
  ['code' =>'Px','description' =>'Prison, Exile Camp', 'extra_info' => 'Main World'],
  ['code' =>'Pe','description' => 'Penal Colony', 'extra_info' => 'Not Main World'],
  ['code' =>'Re','description' =>'Reserve'],
  ['code' =>'Cp','description' =>'Subsector Capital'],
  ['code' =>'Cs','description' =>'Sector Capital'],
  ['code' =>'Cx','description' =>'Capital'],
  ['code' =>'Sa','description' =>'Satellite', 'extra_info' => 'Main World is a moon of a Gas Giant'],
  ['code' =>'Fo','description' =>'Forbidden', 'extra_info' => 'Red Zone'],
  ['code' =>'Pz','description' => 'Puzzle', 'extra_info' => 'Amber Zone, Pop 7+'],
  ['code' =>'Da','description' => 'Danger', 'extra_info' => 'Amber Zone, Pop 6-'],
  ['code' =>'Ab','description' =>'Data Repository'],
  ['code' =>'An','description' =>'Ancient Site'],

  ['code' =>'Rs','description' => 'Research Station', 'extra_info' => 'Imperial'],
  ['code' =>'Nh','description' => 'Non-Hiver Population', 'extra_info' => 'Hiver'],
  ['code' =>'Nk','description' =>'Non-Kkree Population', 'extra_info' => 'K\'kree'],

  ['code' =>'Tp','description' => 'Terra-prime', 'extra_info' => 'Adventure 5: Leviathan'],
  ['code' =>'Tn','description' => 'Terra-norm', 'extra_info' => 'Adventure 5: Leviathan'],
  ['code' =>'Lt','description' => 'Low Technology', 'extra_info' => 'Mongoose Publishing'],
  ['code' =>'Ht','description' => 'High Technology', 'extra_info' => 'Mongoose Publishing'],

  ['code' =>'Fa','description' => 'Fascinating', 'extra_info' => 'Hiver'],
  ['code' =>'St','description' => 'Steppeworld', 'extra_info' => 'K\'kree'],
  ['code' =>'Ex','description' => 'Exile Camp', 'extra_info' => 'Imperial'],
  ['code' =>'Pr','description' => 'Prison World', 'extra_info' => 'Imperial'],
  ['code' =>'Xb','description' => 'Xboat Station', 'extra_info' => 'Imperial'],
  ['code' =>'Cr','description' => 'Reserve Capital', 'extra_info' => 'Zhodani'],

  ['code' =>'RsA', 'description' => 'Research Station Alpha'],
  ['code' =>'RsB', 'description' => 'Research Station Beta'],
  ['code' =>'RsG', 'description' => 'Research Station Gamma'],
  ['code' =>'RsD', 'description' => 'Research Station Delta'],
  ['code' =>'RsE', 'description' => 'Research Station Epsilon'],
  ['code' =>'RsZ', 'description' => 'Research Station Zeta'],
  ['code' =>'RsH', 'description' => 'Research Station Eta'],
  ['code' =>'RsT', 'description' => 'Research Station Theta'],
  ['code' =>'Cy','description' =>'Colony'],
];
$data = [
  ['bundle' => 'starport','code' => 'A', 'description' => 'Excellent', 'extra_data' => ['long_description' => 'Excellent Quality. Refined fuel available. Annual maintenance overhaul available. Shipyard capable of constructing starships and non-starships present. Naval base and\/or scout base may be present.']],
  ['bundle' => 'starport','code' => 'B', 'description' => 'Good', 'extra_data' => ['long_description' => 'Good Quality. Refined fuel available. Annual maintenance overhaul available. Shipyard capable of constructing non-starships present. Naval base and\/or scout base may be present.']],
  ['bundle' => 'starport','code' => 'C', 'description' => 'Routine', 'extra_data' => ['long_description' => 'Routine Quality. Only unrefined fuel available. Reasonable repair facilities present. Scout base may be present.']],
  ['bundle' => 'starport','code' => 'D', 'description' => 'Poor', 'extra_data' => ['long_description' => 'Poor Quality. Only unrefined fuel available. No repair facilities present. Scout base may be present.']],
  ['bundle' => 'starport','code' => 'E', 'description' => 'Frontier Installation', 'extra_data' => ['long_description' => 'Frontier Installation. Essentially a marked spot of bedrock with no fuel, facilities, or bases present.']],
  ['bundle' => 'starport','code' => 'X', 'description' => 'None or Unknown', 'extra_data' => ['long_description' => 'No Starport. No provision is made for any ship landings.']],
  ['bundle' => 'starport','code' => 'F', 'description' => 'Good', 'extra_data' => ['long_description' => '(Spaceport) Good Quality. Minor damage repairable. Unrefined fuel available.']],
  ['bundle' => 'starport','code' => 'G', 'description' => 'Poor', 'extra_data' => ['long_description' => '(Spaceport) Poor Quality. Limited repair capability. Only unrefined fuel available.']],
  ['bundle' => 'starport','code' => 'H', 'description' => 'Primitive', 'extra_data' => ['long_description' => '(Spaceport) Primitive. No repair capability. No repairs available.']],
  ['bundle' => 'starport','code' => 'Y', 'description' => 'None', 'extra_data' => ['long_description' => 'No Starport. No provision is made for any ship landings.']],
  ['bundle' => 'starport','code' => '?', 'description' => 'Unknown', 'extra_data' => ['long_description' => 'No information or starport classification found.]']],

  ['bundle' => 'world_size', 'code' =>'0', 'description' => 'Asteroid Belt'],
  ['bundle' => 'world_size', 'code' =>'S', 'description' => 'Small World'],
  ['bundle' => 'world_size', 'code' =>'1', 'description' => '1,600km (0.12g)', 'extra_data' => ['diameter' => 1600, 'mass' => 0.0019, 'area' => 0.015, 'gravity' => 0.122, 'esc_velocity' => 1.35]],
  ['bundle' => 'world_size', 'code' =>'2', 'description' => '3,200km (0.25g)', 'extra_data' => ['diameter' => 3200, 'mass' => 0.015, 'area' => 0.063, 'gravity' => 0.240, 'esc_velocity' => 2.69]],
  ['bundle' => 'world_size', 'code' =>'3', 'description' => '4,800km (0.38g)', 'extra_data' => ['diameter' => 4800, 'mass' => 0.053, 'area' => 0.141, 'gravity' => 0.377, 'esc_velocity' => 4.13]],
  ['bundle' => 'world_size', 'code' =>'4', 'description' => '6,400km (0.50g)', 'extra_data' => ['diameter' => 6400, 'mass' => 0.125, 'area' => 0.250, 'gravity' => 0.500, 'esc_velocity' => 5.49]],
  ['bundle' => 'world_size', 'code' =>'5', 'description' => '8,000km (0.63g)', 'extra_data' => ['diameter' => 8000, 'mass' => 0.244, 'area' => 0.391, 'gravity' => 0.625, 'esc_velocity' => 6.87]],
  ['bundle' => 'world_size', 'code' =>'6', 'description' => '9,600km (0.75g)', 'extra_data' => ['diameter' => 9600, 'mass' => 0.422, 'area' => 0.563, 'gravity' => 0.840, 'esc_velocity' => 8.72]],
  ['bundle' => 'world_size', 'code' =>'7', 'description' => '11,200km (0.88g)', 'extra_data' => ['diameter' => 11200, 'mass' => 0.670, 'area' => 0.766, 'gravity' => 0.875, 'esc_velocity' => 9.62]],
  ['bundle' => 'world_size', 'code' =>'8', 'description' => '12,800km (1.0g)', 'extra_data' => ['diameter' => 12800, 'mass' => 1.000, 'area' => 1.000, 'gravity' => 1.000, 'esc_velocity' => 11.00]],
  ['bundle' => 'world_size', 'code' =>'9', 'description' => '14,400km (1.12g)', 'extra_data' => ['diameter' => 14400, 'mass' => 1.424, 'area' => 1.266, 'gravity' => 1.120, 'esc_velocity' => 12.35]],
  ['bundle' => 'world_size', 'code' =>'A', 'description' => '16,000km (1.25g)', 'extra_data' => ['diameter' => 16000, 'mass' => 1.953, 'area' => 1.563, 'gravity' => 1.250, 'esc_velocity' => 13.73]],
  ['bundle' => 'world_size', 'code' =>'B', 'description' => '17,600km (1.38g)', 'extra_data' => ['diameter' => 18800, 'mass' => 2.600, 'area' => 1.891, 'gravity' => 1.375, 'esc_velocity' => 15.34]],
  ['bundle' => 'world_size', 'code' =>'C', 'description' => '19,200km (1.50g)', 'extra_data' => ['diameter' => 19200, 'mass' => 3.375, 'area' => 2.250, 'gravity' => 1.500, 'esc_velocity' => 16.74]],
  ['bundle' => 'world_size', 'code' =>'D', 'description' => '20,800km (1.63g)', 'extra_data' => ['diameter' => 20800, 'mass' => 4.291, 'area' => 2.641, 'gravity' => 1.625, 'esc_velocity' => 18.13]],
  ['bundle' => 'world_size', 'code' =>'E', 'description' => '22,400km (1.75g)', 'extra_data' => ['diameter' => 22400, 'mass' => 5.359, 'area' => 3.063, 'gravity' => 1.750, 'esc_velocity' => 19.52]],
  ['bundle' => 'world_size', 'code' =>'F', 'description' => '24,000km (2.0g)', 'extra_data' => ['diameter' => 24000, 'mass' => 6.592, 'area' => 3.516, 'gravity' => 1.875, 'esc_velocity' => 20.92]],
  ['bundle' => 'world_size', 'code' =>'X', 'description' => 'Unknown'],
  ['bundle' => 'world_size', 'code' =>'?', 'description' => 'Unknown'],
  ['bundle' => 'atmosphere', 'code' => '0', 'description' => 'No atmosphere'],
  ['bundle' => 'atmosphere', 'code' => '1', 'description' => 'Trace'],
  ['bundle' => 'atmosphere', 'code' => '2', 'description' => 'Very thin; Tainted'],
  ['bundle' => 'atmosphere', 'code' => '3', 'description' => 'Very thin'],
  ['bundle' => 'atmosphere', 'code' => '4', 'description' => 'Thin; Tainted'],
  ['bundle' => 'atmosphere', 'code' => '5', 'description' => 'Thin'],
  ['bundle' => 'atmosphere', 'code' => '6', 'description' => 'Standard'],
  ['bundle' => 'atmosphere', 'code' => '7', 'description' => 'Standard; Tainted'],
  ['bundle' => 'atmosphere', 'code' => '8', 'description' => 'Dense'],
  ['bundle' => 'atmosphere', 'code' => '9', 'description' => 'Dense; Tainted'],
  ['bundle' => 'atmosphere', 'code' => 'A', 'description' => 'Exotic'],
  ['bundle' => 'atmosphere', 'code' => 'B', 'description' => 'Corrosive'],
  ['bundle' => 'atmosphere', 'code' => 'C', 'description' => 'Insidious'],
  ['bundle' => 'atmosphere', 'code' => 'D', 'description' => 'Dense, high'],
  ['bundle' => 'atmosphere', 'code' => 'E', 'description' => 'Thin, low'],
  ['bundle' => 'atmosphere', 'code' => 'F', 'description' => 'Unusual'],
  ['bundle' => 'atmosphere', 'code' => 'X', 'description' => 'Unknown'],
  ['bundle' => 'atmosphere', 'code' => '?', 'description' => 'Unknown'],
  ['bundle' => 'hydrographics', 'code' => '0', 'description' => 'Desert World'],
  ['bundle' => 'hydrographics', 'code' => '1', 'description' => '10%'],
  ['bundle' => 'hydrographics', 'code' => '2', 'description' => '20%'],
  ['bundle' => 'hydrographics', 'code' => '3', 'description' => '30%'],
  ['bundle' => 'hydrographics', 'code' => '4', 'description' => '40%'],
  ['bundle' => 'hydrographics', 'code' => '5', 'description' => '50%'],
  ['bundle' => 'hydrographics', 'code' => '6', 'description' => '60%'],
  ['bundle' => 'hydrographics', 'code' => '7', 'description' => '70%'],
  ['bundle' => 'hydrographics', 'code' => '8', 'description' => '80%'],
  ['bundle' => 'hydrographics', 'code' => '9', 'description' => '90%'],
  ['bundle' => 'hydrographics', 'code' => 'A', 'description' => 'Water World'],
  ['bundle' => 'hydrographics', 'code' => 'X', 'description' => 'Unknown'],
  ['bundle' => 'hydrographics', 'code' => '?', 'description' => 'Unknown'],
  ['bundle' => 'population_exponent', 'code' => '0', 'description' => 'Unpopulated'],
  ['bundle' => 'population_exponent', 'code' => '1', 'description' => 'Tens'],
  ['bundle' => 'population_exponent', 'code' => '2', 'description' => 'Hundreds'],
  ['bundle' => 'population_exponent', 'code' => '3', 'description' => 'Thousands'],
  ['bundle' => 'population_exponent', 'code' => '4', 'description' => 'Tens of thousands'],
  ['bundle' => 'population_exponent', 'code' => '5', 'description' => 'Hundreds of thousands'],
  ['bundle' => 'population_exponent', 'code' => '6', 'description' => 'Millions'],
  ['bundle' => 'population_exponent', 'code' => '7', 'description' => 'Tens of millions'],
  ['bundle' => 'population_exponent', 'code' => '8', 'description' => 'Hundreds of millions'],
  ['bundle' => 'population_exponent', 'code' => '9', 'description' => 'Billions'],
  ['bundle' => 'population_exponent', 'code' => 'A', 'description' => 'Tens of billions'],
  ['bundle' => 'population_exponent', 'code' => 'B', 'description' => 'Hundreds of billions'],
  ['bundle' => 'population_exponent', 'code' => 'C', 'description' => 'Trillions'],
  ['bundle' => 'population_exponent', 'code' => 'D', 'description' => 'Tens of trillions'],
  ['bundle' => 'population_exponent', 'code' => 'E', 'description' => 'Hundreds of tillions'],
  ['bundle' => 'population_exponent', 'code' => 'F', 'description' => 'Quadrillions'],
  ['bundle' => 'population_exponent', 'code' => 'X', 'description' => 'Unknown'],
  ['bundle' => 'population_exponent', 'code' => '?', 'description' => 'Unknown'],

  ['bundle' => 'government', 'code' => '0', 'description' => 'No Government Structure'],
  ['bundle' => 'government', 'code' => '1', 'description' => 'Company/Corporation'],
  ['bundle' => 'government', 'code' => '2', 'description' => 'Participating Democracy'],
  ['bundle' => 'government', 'code' => '3', 'description' => 'Self-Perpetuating Oligarchy'],
  ['bundle' => 'government', 'code' => '4', 'description' => 'Representative Democracy'],
  ['bundle' => 'government', 'code' => '5', 'description' => 'Feudal Technocracy'],
  ['bundle' => 'government', 'code' => '6', 'description' => 'Captive Government / Colony'],
  ['bundle' => 'government', 'code' => '7', 'description' => 'Balkanization'],
  ['bundle' => 'government', 'code' => '8', 'description' => 'Civil Service Bureaucracy'],
  ['bundle' => 'government', 'code' => '9', 'description' => 'Impersonal Bureaucracy'],
  ['bundle' => 'government', 'code' => 'A', 'description' => 'Charismatic Dictator'],
  ['bundle' => 'government', 'code' => 'B', 'description' => 'Non-Charismatic Dictator'],
  ['bundle' => 'government', 'code' => 'C', 'description' => 'Charismatic Oligarchy'],
  ['bundle' => 'government', 'code' => 'D', 'description' => 'Religious Dictatorship'],
  ['bundle' => 'government', 'code' => 'E', 'description' => 'Religious Autocracy'],
  ['bundle' => 'government', 'code' => 'F', 'description' => 'Totalitarian Oligarchy'],
  ['bundle' => 'government', 'code' => 'X', 'description' => 'Unknown'],
  ['bundle' => 'government', 'code' => '?', 'description' => 'Unknown'],

  // Legacy/Non-Human
  ['bundle' => 'government', 'code' => 'G', 'description' => 'Small Station or Facility (Aslan)'],
  ['bundle' => 'government', 'code' => 'H', 'description' => 'Split Clan Control (Aslan)'],
  ['bundle' => 'government', 'code' => 'J', 'description' => 'Single On-world Clan Control (Aslan)'],
  ['bundle' => 'government', 'code' => 'K', 'description' => 'Single Multi-world Clan Control (Aslan)'],
  ['bundle' => 'government', 'code' => 'L', 'description' => 'Major Clan Control (Aslan)'],
  ['bundle' => 'government', 'code' => 'M', 'description' => 'Vassal Clan Control (Aslan)'],
  ['bundle' => 'government', 'code' => 'N', 'description' => 'Major Vassal Clan Control (Aslan)'],
  ['bundle' => 'government', 'code' => 'P', 'description' => 'Small Station or Facility (K\'Kree)'],
  ['bundle' => 'government', 'code' => 'Q', 'description' => 'Krurruna or Krumanak Rule for Off-world Steppelord (K\'Kree)'],
  ['bundle' => 'government', 'code' => 'R', 'description' => 'Steppelord On-world Rule (K\'Kree)'],
  ['bundle' => 'government', 'code' => 'S', 'description' => 'Sept (Hiver)'],
  ['bundle' => 'government', 'code' => 'T', 'description' => 'Unsupervised Anarchy (Hiver)'],
  ['bundle' => 'government', 'code' => 'U', 'description' => 'Supervised Anarchy (Hiver)'],
  ['bundle' => 'government', 'code' => 'W', 'description' => 'Committee (Hiver)'],
  ['bundle' => 'government', 'code' => 'X', 'description' => 'Droyne Hierarchy'], // Need a hack for this

  ['bundle' => 'law_level', 'code' => '0', 'description' => 'No prohibitions'],
  ['bundle' => 'law_level', 'code' => '1', 'description' => 'Body pistols, explosives, and poison gas prohibited'],
  ['bundle' => 'law_level', 'code' => '2', 'description' => 'Portable energy weapons prohibited'],
  ['bundle' => 'law_level', 'code' => '3', 'description' => 'Machine guns, automatic rifles prohibited'],
  ['bundle' => 'law_level', 'code' => '4', 'description' => 'Light assault weapons prohibited'],
  ['bundle' => 'law_level', 'code' => '5', 'description' => 'Personal concealable weapons prohibited'],
  ['bundle' => 'law_level', 'code' => '6', 'description' => 'All firearms except shotguns prohibited'],
  ['bundle' => 'law_level', 'code' => '7', 'description' => 'Shotguns prohibited'],
  ['bundle' => 'law_level', 'code' => '8', 'description' => 'Long bladed weapons controlled; open possession prohibited'],
  ['bundle' => 'law_level', 'code' => '9', 'description' => 'Possession of weapons outside the home prohibited'],
  ['bundle' => 'law_level', 'code' => 'A', 'description' => 'Weapon possession prohibited'],
  ['bundle' => 'law_level', 'code' => 'B', 'description' => 'Rigid control of civilian movement'],
  ['bundle' => 'law_level', 'code' => 'C', 'description' => 'Unrestricted invasion of privacy'],
  ['bundle' => 'law_level', 'code' => 'D', 'description' => 'Paramilitary law enforcement'],
  ['bundle' => 'law_level', 'code' => 'E', 'description' => 'Full-fledged police state'],
  ['bundle' => 'law_level', 'code' => 'F', 'description' => 'All facets of daily life regularly legislated and controlled'],
  ['bundle' => 'law_level', 'code' => 'G', 'description' => 'Severe punishment for petty infractions'],
  ['bundle' => 'law_level', 'code' => 'H', 'description' => 'Legalized oppressive practices'],
  ['bundle' => 'law_level', 'code' => 'J', 'description' => 'Routinely oppressive and restrictive'],
  ['bundle' => 'law_level', 'code' => 'K', 'description' => 'Excessively oppressive and restrictive'],
  ['bundle' => 'law_level', 'code' => 'L', 'description' => 'Totally oppressive and restrictive'],
  ['bundle' => 'law_level', 'code' => 'S', 'description' => 'Special/Variable situation'],
  ['bundle' => 'law_level', 'code' => 'X', 'description' => 'Unknown'],
  ['bundle' => 'law_level', 'code' => '?', 'description' => 'Unknown'],

  ['bundle' => 'tech_level', 'code' => '0', 'description' => 'Stone Age'],
  ['bundle' => 'tech_level', 'code' => '1', 'description' => 'Bronze, Iron Age'],
  ['bundle' => 'tech_level', 'code' => '2', 'description' => 'Printing Press'],
  ['bundle' => 'tech_level', 'code' => '3', 'description' => 'Basic Science'],
  ['bundle' => 'tech_level', 'code' => '4', 'description' => 'External Combustion'],
  ['bundle' => 'tech_level', 'code' => '5', 'description' => 'Mass Production'],
  ['bundle' => 'tech_level', 'code' => '6', 'description' => 'Nuclear Power'],
  ['bundle' => 'tech_level', 'code' => '7', 'description' => 'Miniaturized Electronics'],
  ['bundle' => 'tech_level', 'code' => '8', 'description' => 'Quality Computers'],
  ['bundle' => 'tech_level', 'code' => '9', 'description' => 'Anti-Gravity'],
  ['bundle' => 'tech_level', 'code' => 'A', 'description' => 'Interstellar community'],
  ['bundle' => 'tech_level', 'code' => 'B', 'description' => 'Lower Average Imperial'],
  ['bundle' => 'tech_level', 'code' => 'C', 'description' => 'Average Imperial'],
  ['bundle' => 'tech_level', 'code' => 'D', 'description' => 'Above Average Imperial'],
  ['bundle' => 'tech_level', 'code' => 'E', 'description' => 'Above Average Imperial'],
  ['bundle' => 'tech_level', 'code' => 'F', 'description' => 'Technical Imperial Maximum'],
  ['bundle' => 'tech_level', 'code' => 'G', 'description' => 'Robots'],
  ['bundle' => 'tech_level', 'code' => 'H', 'description' => 'Artificial Intelligence'],
  ['bundle' => 'tech_level', 'code' => 'J', 'description' => 'Personal Disintegrators'],
  ['bundle' => 'tech_level', 'code' => 'K', 'description' => 'Plastic Metals'],
  ['bundle' => 'tech_level', 'code' => 'L', 'description' => 'Comprehensible only as technological magic'],
  ['bundle' => 'tech_level', 'code' => 'X', 'description' => 'Unknown'],
  ['bundle' => 'tech_level', 'code' => '?', 'description' => 'Unknown'], 

  ['bundle' => 'importance', 'code' => '-3', 'description' => 'Very unimportant'],
  ['bundle' => 'importance', 'code' => '-2', 'description' => 'Very unimportant'],
  ['bundle' => 'importance', 'code' => '-1', 'description' => 'Unimportant'],
  ['bundle' => 'importance', 'code' => '0', 'description' => 'Unimportant'],
  ['bundle' => 'importance', 'code' => '1', 'description' => 'Ordinary'],
  ['bundle' => 'importance', 'code' => '2', 'description' => 'Ordinary'],
  ['bundle' => 'importance', 'code' => '3', 'description' => 'Ordinary'],
  ['bundle' => 'importance', 'code' => '4', 'description' => 'Important'],
  ['bundle' => 'importance', 'code' => '5', 'description' => 'Very important'],
  ['bundle' => 'importance', 'code' => '?', 'description' => 'Unknown'],

  ['bundle' => 'econ_resources', 'code' => '2', 'description' => 'Very scarce'],
  ['bundle' => 'econ_resources', 'code' => '3', 'description' => 'Very scarce'],
  ['bundle' => 'econ_resources', 'code' => '4', 'description' => 'Scarce'],
  ['bundle' => 'econ_resources', 'code' => '5', 'description' => 'Scarce'],
  ['bundle' => 'econ_resources', 'code' => '6', 'description' => 'Few'],
  ['bundle' => 'econ_resources', 'code' => '7', 'description' => 'Few'],
  ['bundle' => 'econ_resources', 'code' => '8', 'description' => 'Moderate'],
  ['bundle' => 'econ_resources', 'code' => '9', 'description' => 'Moderate'],
  ['bundle' => 'econ_resources', 'code' => 'A', 'description' => 'Abundant'],
  ['bundle' => 'econ_resources', 'code' => 'B', 'description' => 'Abundant'],
  ['bundle' => 'econ_resources', 'code' => 'C', 'description' => 'Very abundant'],
  ['bundle' => 'econ_resources', 'code' => 'D', 'description' => 'Very abundant'],
  ['bundle' => 'econ_resources', 'code' => 'E', 'description' => 'Extremely abundant'],
  ['bundle' => 'econ_resources', 'code' => 'F', 'description' => 'Extremely abundant'],
  ['bundle' => 'econ_resources', 'code' => 'G', 'description' => 'Extremely abundant'],
  ['bundle' => 'econ_resources', 'code' => 'H', 'description' => 'Extremely abundant'],
  ['bundle' => 'econ_resources', 'code' => 'J', 'description' => 'Extremely abundant'],
  ['bundle' => 'econ_resources', 'code' => '?', 'description' => 'Unknown'],

  ['bundle' => 'econ_infrastructure', 'code' => '0', 'description' => 'Non-existent'],
  ['bundle' => 'econ_infrastructure', 'code' => '1', 'description' => 'Extremely limited'],
  ['bundle' => 'econ_infrastructure', 'code' => '2', 'description' => 'Extremely limited'],
  ['bundle' => 'econ_infrastructure', 'code' => '3', 'description' => 'Very limited'],
  ['bundle' => 'econ_infrastructure', 'code' => '4', 'description' => 'Very limited'],
  ['bundle' => 'econ_infrastructure', 'code' => '5', 'description' => 'Limited'],
  ['bundle' => 'econ_infrastructure', 'code' => '6', 'description' => 'Limited'],
  ['bundle' => 'econ_infrastructure', 'code' => '7', 'description' => 'Generally available'],
  ['bundle' => 'econ_infrastructure', 'code' => '8', 'description' => 'Generally available'],
  ['bundle' => 'econ_infrastructure', 'code' => '9', 'description' => 'Extensive'],
  ['bundle' => 'econ_infrastructure', 'code' => 'A', 'description' => 'Extensive'],
  ['bundle' => 'econ_infrastructure', 'code' => 'B', 'description' => 'Very extensive'],
  ['bundle' => 'econ_infrastructure', 'code' => 'C', 'description' => 'Very extensive'],
  ['bundle' => 'econ_infrastructure', 'code' => 'D', 'description' => 'Comprehensive'],
  ['bundle' => 'econ_infrastructure', 'code' => 'E', 'description' => 'Comprehensive'],
  ['bundle' => 'econ_infrastructure', 'code' => 'F', 'description' => 'Very comprehensive'],
  ['bundle' => 'econ_infrastructure', 'code' => 'G', 'description' => 'Very comprehensive'],
  ['bundle' => 'econ_infrastructure', 'code' => 'H', 'description' => 'Very comprehensive'],
  ['bundle' => 'econ_infrastructure', 'code' => '?', 'description' => 'Unknown'],

  ['bundle' => 'econ_efficiency', 'code' => '-5', 'description' => 'Extremely poor'],
  ['bundle' => 'econ_efficiency', 'code' => '-4', 'description' => 'Very poor'],
  ['bundle' => 'econ_efficiency', 'code' => '-3', 'description' => 'Poor'],
  ['bundle' => 'econ_efficiency', 'code' => '-2', 'description' => 'Fair'],
  ['bundle' => 'econ_efficiency', 'code' => '-1', 'description' => 'Average'],
  ['bundle' => 'econ_efficiency', 'code' => '0', 'description' => 'Average'],
  ['bundle' => 'econ_efficiency', 'code' => '+1', 'description' => 'Average'],
  ['bundle' => 'econ_efficiency', 'code' => '+2', 'description' => 'Good'],
  ['bundle' => 'econ_efficiency', 'code' => '+3', 'description' => 'Improved'],
  ['bundle' => 'econ_efficiency', 'code' => '+4', 'description' => 'Advanced'],
  ['bundle' => 'econ_efficiency', 'code' => '+5', 'description' => 'Very advanced'],
  ['bundle' => 'econ_efficiency', 'code' => '?', 'description' => 'Unknown'],

  ['bundle' => 'cult_heterogeneity', 'code' => '0', 'description' => 'N/A'],
  ['bundle' => 'cult_heterogeneity', 'code' => '1', 'description' => 'Monolithic'],
  ['bundle' => 'cult_heterogeneity', 'code' => '2', 'description' => 'Monolithic'],
  ['bundle' => 'cult_heterogeneity', 'code' => '3', 'description' => 'Monolithic'],
  ['bundle' => 'cult_heterogeneity', 'code' => '4', 'description' => 'Harmonious'],
  ['bundle' => 'cult_heterogeneity', 'code' => '5', 'description' => 'Harmonious'],
  ['bundle' => 'cult_heterogeneity', 'code' => '6', 'description' => 'Harmonious'],
  ['bundle' => 'cult_heterogeneity', 'code' => '7', 'description' => 'Discordant'],
  ['bundle' => 'cult_heterogeneity', 'code' => '8', 'description' => 'Discordant'],
  ['bundle' => 'cult_heterogeneity', 'code' => '9', 'description' => 'Discordant'],
  ['bundle' => 'cult_heterogeneity', 'code' => 'A', 'description' => 'Discordant'],
  ['bundle' => 'cult_heterogeneity', 'code' => 'B', 'description' => 'Discordant'],
  ['bundle' => 'cult_heterogeneity', 'code' => 'C', 'description' => 'Fragmented'],
  ['bundle' => 'cult_heterogeneity', 'code' => 'D', 'description' => 'Fragmented'],
  ['bundle' => 'cult_heterogeneity', 'code' => 'E', 'description' => 'Fragmented'],
  ['bundle' => 'cult_heterogeneity', 'code' => 'F', 'description' => 'Fragmented'],
  ['bundle' => 'cult_heterogeneity', 'code' => 'G', 'description' => 'Fragmented'],
  ['bundle' => 'cult_heterogeneity', 'code' => '?', 'description' => 'Unknown'],

  ['bundle' => 'cult_acceptance', 'code' => '0', 'description' => 'N/A'],
  ['bundle' => 'cult_acceptance', 'code' => '1', 'description' => 'Extremely xenophobic'],
  ['bundle' => 'cult_acceptance', 'code' => '2', 'description' => 'Very xenophobic'],
  ['bundle' => 'cult_acceptance', 'code' => '3', 'description' => 'Xenophobic'],
  ['bundle' => 'cult_acceptance', 'code' => '4', 'description' => 'Extremely aloof'],
  ['bundle' => 'cult_acceptance', 'code' => '5', 'description' => 'Very aloof'],
  ['bundle' => 'cult_acceptance', 'code' => '6', 'description' => 'Aloof'],
  ['bundle' => 'cult_acceptance', 'code' => '7', 'description' => 'Aloof'],
  ['bundle' => 'cult_acceptance', 'code' => '8', 'description' => 'Friendly'],
  ['bundle' => 'cult_acceptance', 'code' => '9', 'description' => 'Friendly'],
  ['bundle' => 'cult_acceptance', 'code' => 'A', 'description' => 'Very friendly'],
  ['bundle' => 'cult_acceptance', 'code' => 'B', 'description' => 'Extremely friendly'],
  ['bundle' => 'cult_acceptance', 'code' => 'C', 'description' => 'Xenophilic'],
  ['bundle' => 'cult_acceptance', 'code' => 'D', 'description' => 'Very Xenophilic'],
  ['bundle' => 'cult_acceptance', 'code' => 'E', 'description' => 'Extremely xenophilic'],
  ['bundle' => 'cult_acceptance', 'code' => 'F', 'description' => 'Extremely xenophilic'],
  ['bundle' => 'cult_acceptance', 'code' => '?', 'description' => 'Unknown'],

  ['bundle' => 'cult_strangeness', 'code' => '0', 'description' => 'N/A'],
  ['bundle' => 'cult_strangeness', 'code' => '1', 'description' => 'Very typical'],
  ['bundle' => 'cult_strangeness', 'code' => '2', 'description' => 'Typical'],
  ['bundle' => 'cult_strangeness', 'code' => '3', 'description' => 'Somewhat typical'],
  ['bundle' => 'cult_strangeness', 'code' => '4', 'description' => 'Somewhat distinct'],
  ['bundle' => 'cult_strangeness', 'code' => '5', 'description' => 'Distinct'],
  ['bundle' => 'cult_strangeness', 'code' => '6', 'description' => 'Very distinct'],
  ['bundle' => 'cult_strangeness', 'code' => '7', 'description' => 'Confusing'],
  ['bundle' => 'cult_strangeness', 'code' => '8', 'description' => 'Very confusing'],
  ['bundle' => 'cult_strangeness', 'code' => '9', 'description' => 'Extremely confusing'],
  ['bundle' => 'cult_strangeness', 'code' => 'A', 'description' => 'Incomprehensible'],
  ['bundle' => 'cult_strangeness', 'code' => '?', 'description' => 'Unknown'],

  ['bundle' => 'cult_symbols', 'code' => '0', 'description' => 'Extremely concrete'],
  ['bundle' => 'cult_symbols', 'code' => '1', 'description' => 'Extremely concrete'],
  ['bundle' => 'cult_symbols', 'code' => '2', 'description' => 'Very concrete'],
  ['bundle' => 'cult_symbols', 'code' => '3', 'description' => 'Very concrete'],
  ['bundle' => 'cult_symbols', 'code' => '4', 'description' => 'Concrete'],
  ['bundle' => 'cult_symbols', 'code' => '5', 'description' => 'Concrete'],
  ['bundle' => 'cult_symbols', 'code' => '6', 'description' => 'Somewhat concrete'],
  ['bundle' => 'cult_symbols', 'code' => '7', 'description' => 'Somewhat concrete'],
  ['bundle' => 'cult_symbols', 'code' => '8', 'description' => 'Somewhat abstract'],
  ['bundle' => 'cult_symbols', 'code' => '9', 'description' => 'Somewhat abstract'],
  ['bundle' => 'cult_symbols', 'code' => 'A', 'description' => 'Abstract'],
  ['bundle' => 'cult_symbols', 'code' => 'B', 'description' => 'Abstract'],
  ['bundle' => 'cult_symbols', 'code' => 'C', 'description' => 'Very abstract'],
  ['bundle' => 'cult_symbols', 'code' => 'D', 'description' => 'Very abstract'],
  ['bundle' => 'cult_symbols', 'code' => 'E', 'description' => 'Extremely abstract'],
  ['bundle' => 'cult_symbols', 'code' => 'F', 'description' => 'Extremely abstract'],
  ['bundle' => 'cult_symbols', 'code' => 'G', 'description' => 'Extremely abstract'],
  ['bundle' => 'cult_symbols', 'code' => 'H', 'description' => 'Incomprehensibly abstract'],
  ['bundle' => 'cult_symbols', 'code' => 'J', 'description' => 'Incomprehensibly abstract'],
  ['bundle' => 'cult_symbols', 'code' => 'K', 'description' => 'Incomprehensibly abstract'],
  ['bundle' => 'cult_symbols', 'code' => 'L', 'description' => 'Incomprehensibly abstract'],
  ['bundle' => 'cult_symbols', 'code' => '?', 'description' => 'Unknown'],

  ['bundle' => 'nobility', 'code' => 'B', 'description' => 'Knight'],
  ['bundle' => 'nobility', 'code' => 'c', 'description' => 'Baronet'],
  ['bundle' => 'nobility', 'code' => 'C', 'description' => 'Baron'],
  ['bundle' => 'nobility', 'code' => 'D', 'description' => 'Marquis'],
  ['bundle' => 'nobility', 'code' => 'e', 'description' => 'Viscount'],
  ['bundle' => 'nobility', 'code' => 'E', 'description' => 'Count'],
  ['bundle' => 'nobility', 'code' => 'f', 'description' => 'Duke'],
  ['bundle' => 'nobility', 'code' => 'F', 'description' => 'Subsector Duke'],
  ['bundle' => 'nobility', 'code' => 'G', 'description' => 'Archduke'],
  ['bundle' => 'nobility', 'code' => 'H', 'description' => 'Emperor'],
  ['bundle' => 'nobility', 'code' => '?', 'description' => 'Unknown'],

  ['bundle' => 'base', 'code' => 'C', 'description' => 'Corsair Base'],
  ['bundle' => 'base', 'code' => 'D', 'description' => 'Naval Depot'],
  ['bundle' => 'base', 'code' => 'E', 'description' => 'Embassy'],
  ['bundle' => 'base', 'code' => 'H', 'description' => 'Hiver Supply Base'],
  ['bundle' => 'base', 'code' => 'I', 'description' => 'Interface'],
  ['bundle' => 'base', 'code' => 'K', 'description' => 'Naval Base'],
  ['bundle' => 'base', 'code' => 'L', 'description' => 'Naval Base'],
  ['bundle' => 'base', 'code' => 'M', 'description' => 'Military Base'],
  ['bundle' => 'base', 'code' => 'N', 'description' => 'Naval Base'],
  ['bundle' => 'base', 'code' => 'O', 'description' => 'Naval Outpost'],
  ['bundle' => 'base', 'code' => 'R', 'description' => 'Clan Base'],
  ['bundle' => 'base', 'code' => 'S', 'description' => 'Scout Base'],
  ['bundle' => 'base', 'code' => 'T', 'description' => 'Tlauku Base'],
  ['bundle' => 'base', 'code' => 'V', 'description' => 'Exploration Base'],
  ['bundle' => 'base', 'code' => 'W', 'description' => 'Way Station'],
  ['bundle' => 'base', 'code' => 'X', 'description' => 'Relay Station'],
  ['bundle' => 'base', 'code' => 'Z', 'description' => 'Naval/Military Base'],
  ['bundle' => 'star', 'code' => 'Ia', 'description' => 'Supergiant'],
  ['bundle' => 'star', 'code' => 'Ib', 'description' => 'Supergiant'],
  ['bundle' => 'star', 'code' => 'II', 'description' => 'Giant'],
  ['bundle' => 'star', 'code' => 'III', 'description' => 'Giant'],
  ['bundle' => 'star', 'code' => 'IV', 'description' => 'Subgiant'],
  ['bundle' => 'star', 'code' => 'V', 'description' => 'Dwarf'],
  ['bundle' => 'star', 'code' => 'D', 'description' => 'White Dwarf'],
  ['bundle' => 'star', 'code' => 'BD', 'description' => 'Brown Dwarf'],
  ['bundle' => 'star', 'code' => 'BH', 'description' => 'Black Hole'],
  ['bundle' => 'star', 'code' => 'PSR', 'description' => 'Pulsar'],
  ['bundle' => 'star', 'code' => 'NS', 'description' => 'Neutron Star'],
  ['bundle' => 'zone', 'code' => 'R', 'description' => 'Red. Interdicted. Dangerous. Prohibited'],
  ['bundle' => 'zone', 'code' => 'A', 'description' => 'Amber. Potentially dangerous. Caution advised'],
  ['bundle' => 'zone', 'code' => 'G', 'description' => 'Green. Unrestricted.Imperial'],
  ['bundle' => 'zone', 'code' => 'B', 'description' => 'Blue. Balkanized - Government code is dominant government'],
  ['bundle' => 'zone', 'code' => 'F', 'description' => 'Forbidden. Access prohibited'],
  ['bundle' => 'zone', 'code' => 'U', 'description' => 'Unabsorbed. Access restricted'],
];
    //    'T' => 'Terminus',   // For TNE - name Collision
// $data += [
//   // Legacy codes
//   'A' => 'Aslan',
//   'C' => 'Chirper',
//   'D' => 'Droyne',
//   'F' => 'Non-Hiver',
//   'H' => 'Hiver',
//   'I' => 'Ithklur',
//   'M' => 'Human',
//   'V' => 'Vargr',
//   'X' => 'Addaxur',
//   'Z' => 'Zhodani'
//   // T5SS codes populated by live data
// ];

// $data += [
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

// $metadata = [];
// foreach($data as $key => $section){
//   echo "Processing {$key}\n";
//   echo count($section) . " entries\n";
//   $metadata = $metadata + $section;
// }
echo count($data) . " metadata entries\n";
file_put_contents('json/metadata.json', json_encode($data, JSON_PRETTY_PRINT));
file_put_contents('json/remarks.json', json_encode($remarks, JSON_PRETTY_PRINT));

// file_put_contents('json/allegiances_table.json', json_encode(json_decode(file_get_contents('https://travellermap.com/t5ss/allegiances')), JSON_PRETTY_PRINT));
// file_put_contents('json/sophonts_table.json', json_encode(json_decode(file_get_contents('https://travellermap.com/t5ss/sophonts')), JSON_PRETTY_PRINT));
// file_put_contents('json/milieux_table.json', json_encode(json_decode(file_get_contents('https://travellermap.com/api/milieux')), JSON_PRETTY_PRINT));

//    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Arsenal">

