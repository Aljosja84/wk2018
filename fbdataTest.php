

<?php
include_once 'footballData.php';
include_once 'functions.php';
// create new instance of API class
$api = new FootballData();
$standings = $api->getLeagueTable();
$fixtures = $api->getFixtures();
/*
foreach($standings->standings as $key => $value) {
  //create class
  $class = strtolower($key);
  //create table header and legend
  echo "<table class=\"groupTable\">";
  echo "<tr>";
  echo "<td class=\"".$class."\" colspan=\"6\"><b>GROUP ".$key."</b></td>";
  echo "</tr>";
  //legend
  echo "<tr>";

  echo "<td style=\"width:100px\" class=\"groupStage\">team</td>";
  echo "<td style=\"width:10px\" class=\"groupStage\">mp</td>";
  echo "<td style=\"width:10px\" class=\"groupStage\">g</td>";
  echo "<td style=\"width:10px\" class=\"groupStage\">ga</td>";
  echo "<td style=\"width:10px\" class=\"groupStage\">gd</td>";
  echo "<td style=\"width:10px\" class=\"groupStage\">points</td>";
  echo "</tr>";
  foreach($value as $group) {
    echo "<tr>";
    echo "<td style=\"width:10px\" class=\"groupStage\">".$group->team."</td>";
    echo "<td style=\"width:10px\" class=\"groupStage\">".$group->playedGames."</td>";
    echo "<td style=\"width:10px\" class=\"groupStage\">".$group->goals."</td>";
    echo "<td style=\"width:10px\" class=\"groupStage\">".$group->goalsAgainst."</td>";
    echo "<td style=\"width:10px\" class=\"groupStage\">".$group->goalDifference."</td>";
    echo "<td style=\"width:10px\" class=\"groupStage\">".$group->points."</td>";
  }
  echo "</tr>";
  echo "</table>";
}
*/
$standingsArr = $standings->standings->A;
function sortScripts($a, $b)
{
    return $b->points - $a->points;
}

/* sort by points */
// usort($standingsArr, "sortScripts");

foreach($standingsArr as $key => $row)
{
  $standPoints[$key] = $row->points;
  $standGD[$key] = $row->goalDifference;
  $standGM[$key] = $row->goals;
}
array_multisort($standPoints, SORT_DESC, $standGD, SORT_DESC, $standGM, SORT_DESC, $standingsArr);

echo "<pre>";
print_r($standingsArr);
echo "</pre>";

//print_r(statGame('Russia', 'Saudi Arabia', 1));
$stat = statGame('Russia', 'Saudi Arabia', 1);

echo $stat;
?>
