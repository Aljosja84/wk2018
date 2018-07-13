<?php
/** trying JMESPath
 *
 * @author Gabriel Gressie <gabriel.gressie@gmail.com>
 */

require 'vendor/autoload.php';


$jsonFile = file_get_contents('data.json');
$wcJsonData = json_decode($jsonFile, true);

function findTeam($id) {
  $id--;
  return $GLOBALS['wcJsonData']['teams'][$id]['name'];
}
/* select the name of the team with id=1 from teams */
/*$expression = "teams[?id == `1`].name";*/
/* select all id's from matches that will be played in 1(Moscow) */
$stadiumID = 1;
$expressionHome = "groups.*.matches[?stadium == `{$stadiumID}`].home_team | []";
$expressionAway = "groups.*.matches[?stadium == `{$stadiumID}`].away_team | []";
$resHome = JmesPath\search($expressionHome, $wcJsonData);
$resAway = JmesPath\search($expressionAway, $wcJsonData);

/* select all dates where games will be played in stadium 1 */
$expStadDate = "groups.*.matches[?stadium == `{$stadiumID}`].date | []";
$resexpStadDate = JmesPath\search($expStadDate, $wcJsonData);

for($i=0;$i<count($resHome);$i++) {
  echo $resexpStadDate[$i].': ';
  echo findTeam($resHome[$i]).' vs '.findTeam($resAway[$i]).'<br>';
}

// select the match ID from matches when played in stadium 1 and on 14-06-2018
$expStad1Date1 = "groups.*.matches[?stadium == `1` && contains(date, '2018-06-14')].name | []";
$resexpStadDate1 = JmesPath\search($expStad1Date1, $wcJsonData);
echo "<pre>";
print_r($resexpStadDate1);
echo "</pre>";
/* // QUESTION: how many days are there in matchday 1? */
$daysinMatchday1 = "groups.*.matches[?matchday == `1`].date | []";
$resinMatchday1 = JmesPath\search($daysinMatchday1, $wcJsonData);

$timestamp = new DateTime($resinMatchday1[0]);
echo $timestamp->format('Y-m-d');

/* what weekday is a given date */
echo substr($timestampDayoftheWeek = date("l", strtotime($timestamp->format('Y-m-d'))), 0, 3);


$numPD = "groups.*.matches[?matchday == `1`].date | []";
$resnumPD = JmesPath\search($numPD, $wcJsonData);

$arrUniDate = array();
foreach($resnumPD as $key=>$value) {
  $timestamp = new DateTime($value);
  array_push($arrUniDate, $timestamp->format('Y-m-d'));
}
echo count(array_unique($arrUniDate));

function dayOfTheWeek($md, $id) {
  $exp = "groups.*.matches[?matchday == `".$md."`].date | []";
  $res = JmesPath\search($exp, $GLOBALS['wcJsonData']);

  $uniqueDays = array();

  foreach($res as $key => $value){
    array_push($uniqueDays, date('Y-m-d', strtotime($value)));
  }
  $uniqueDays = array_values(array_unique($uniqueDays));
  $timestamp = new DateTime($uniqueDays[$id]);

  /* what weekday is a given date */
  return $uniqueDays;
  //return substr(date("l", strtotime($timestamp->format('Y-m-d'))), 0, 3);
}
echo "<pre>";
print_r( dayOfTheWeek(1, 3));
echo "</pre>";

?>
