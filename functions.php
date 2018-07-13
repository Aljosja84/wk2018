<?php
/** trying JMESPath
 *
 * @author Gabriel Gressie <gabriel.gressie@gmail.com>
 */

require 'vendor/autoload.php';
/* ----------------------------------------------------------------------------- */
$arrStadCap = array(0   => 81000,
                    1   => 45360,
                    2   => 64287,
                    3   => 35212,
                    4   => 45379,
                    5   => 44899,
                    6   => 44918,
                    7   => 45568,
                    8   => 44442,
                    9   => 45000,
                    10  => 41220,
                    11  => 35696);

$countryFlags = array('ru'  =>  'Russia.svg',
                      'sa'  =>  'Saudi_Arabia.svg',
                      'eg'  =>  'Egypt.svg',
                      'uy'  =>  'Uruguay.svg',
                      'pt'  =>  'Portugal.svg',
                      'es'  =>  'Spain.svg',
                      'ma'  =>  'Morocco.svg',
                      'ir'  =>  'Iran.svg',
                      'fr'  =>  'France.svg',
                      'au'  =>  'Australia.svg',
                      'pe'  =>  'Peru.svg',
                      'dk'  =>  'Denmark.svg',
                      'ar'  =>  'Argentina.svg',
                      'is'  =>  'Iceland.svg',
                      'hr'  =>  'Croatia.svg',
                      'ng'  =>  'Nigeria.svg',
                      'br'  =>  'Brazil.svg',
                      'ch'  =>  'Switzerland.svg',
                      'cr'  =>  'Costa_Rica.svg',
                      'rs'  =>  'Serbia.svg',
                      'de'  =>  'Germany.svg',
                      'mx'  =>  'Mexico.svg',
                      'se'  =>  'Sweden.svg',
                      'kr'  =>  'South_Korea.svg',
                      'be'  =>  'Belgium.svg',
                      'pa'  =>  'Panama.svg',
                      'tn'  =>  'Tunisia.svg',
                      'gb-eng'  =>  'England.svg',
                      'pl'  =>  'Poland.svg',
                      'sn'  =>  'Senegal.svg',
                      'co'  =>  'Colombia.svg',
                      'jp'  =>  'Japan.svg');

$timeDiff = array('1'   => 1,
                  '2'   => 1,
                  '3'   => 1,
                  '4'   => 0,
                  '5'   => 1,
                  '6'   => 1,
                  '7'   => 2,
                  '8'   => 1,
                  '9'   => 1,
                  '10'  => 1,
                  '11'  => 1,
                  '12'  => 3);
/* ----------------------------------------------------------------------------- */
include_once 'footballData.php';
// create new instance of API class
$api = new FootballData();
$standings = $api->getLeagueTable();
$fixtures = $api->getFixtures();

$jsonFile = file_get_contents('data.json');
$wcJsonData = json_decode($jsonFile, true);

/** returns the amount of matches in groupfase
 * @return  array   $numMatchesGroup
 */
function numMatchsGroup() {
  $exp = "groups.*.matches[?matchday == `1` || matchday == `2` || matchday == `3`] | []";
  $res = JmesPath\search($exp, $GLOBALS['wcJsonData']);

  $numMatchesGroup = count($res);
  return $numMatchesGroup;
}

function StadRows () {
  $expStads = "stadiums";
  $resexpStads = JmesPath\search($expStads, $GLOBALS['wcJsonData']);

  $numStads = count($resexpStads);
  return $numStads;
}

/** returns the name of the stadium
  * @param  int     $i              ID of stadium
  * @return string  $resStadInfo    name of stadium
  */
function stadiumName ($i) {
  $expStadInfo = "stadiums[$i].name";
  $resStadInfo = JmesPath\search($expStadInfo, $GLOBALS['wcJsonData']);

  return $resStadInfo;
}

/** returns the name of the stadium
  * @param  int      $i              ID of stadium
  * @return string   $resStadInfo    name of city
  */
function stadiumCity ($i) {
  $expStadInfo = "stadiums[$i].city";
  $resStadInfo = JmesPath\search($expStadInfo, $GLOBALS['wcJsonData']);

  return $resStadInfo;
}

  /** returns the number of days in a given matchday
    * @param  int     $id             ID of matchday (1,2,3)
    * @return array   $uniqueDays     a count of $uniqueDays, an array of unique playing days
    */
  function daysinMatchDay($id) {
    $exp = "groups.*.matches[?matchday == `".$id."`].date | []";
    $res = JmesPath\search($exp, $GLOBALS['wcJsonData']);
    /* we need an array with unique playing dates. Because the dates are
       given with times accurate to the minute/seconds, we need to shorten
       them to day-month format to get the results we want
    */
    $uniqueDays = array();
    foreach($res as $key => $value) {
      array_push($uniqueDays, date('d-m', strtotime($value)));
    }
    /* we now have the days in d-m format, so select the array on unique dates only */
    return count(array_unique($uniqueDays));
  }

/** returns an array of unique playing days in a given matchday
  * @param int      $id                 ID of matchday (1,2,3)
  * @return array   $uniqueDays         array of unique playing days
  */
function arrMatchDay($id, $order='us') {
  $exp = "groups.*.matches[?matchday == `".$id."`].date | []";
  $res = JmesPath\search($exp, $GLOBALS['wcJsonData']);
  /* we need an array with unique playing dates. Because the dates are
     given with times accurate to the minute/seconds, we need to shorten
     them to day-month format to get the results we want
  */
  $uniqueDays = array();
  /* check of the date order is d-m(eu) or default: m-d(us) */
  switch($order){
    case 'eu':
    // european notification
    foreach($res as $key => $value){
      array_push($uniqueDays, date('d-m', strtotime($value)));
    }
    break;
    case 'us':
    foreach($res as $key => $value) {
      array_push($uniqueDays, date('m-d', strtotime($value)));
    }
    break;
  }
  /* we now have the days in d-m format, so select the array on unique dates only */
  return array_values(array_unique($uniqueDays));
  }

  /** returns the day of the week on a given match day and stadium
    * @param  int     $md           ID of matchday(1,2,3)
    * @param  int     $id           id of unique day
    * @return string
    */
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
    return substr(date("l", strtotime($timestamp->format('Y-m-d'))), 0, 3);
  }

  /** check for a match ID with a given stadium, date and matchday for redundant reasons
    * @param  int     $SID            Stadium id
    * @param  int     $DID            Date id
    * @param  int     $MID            Matchday ID
    * @return array   ----            Returns the first element of the returning array
    */
  function checkStadiumAndDate($SID, $DID, $MID) {
    $SID++;
    $exp = "groups.*.matches[?stadium == `$SID` && contains(date, '$DID') && matchday == `$MID`].name | []";
    $res = JmesPath\search($exp, $GLOBALS['wcJsonData']);
    /* check if $res is empty */
    if(!empty($res)) {
      return $res[0];
    } else {
      return false;
    }
  }

  function checkClass($id) {
    /* QUESTION : what group does match with id=1 belong to? */
    $groupArr = array('a','b','c','d','e','f','g','h');
    $expGroup = "groups.*.matches[?name==`$id`]";
    $resexpGroup = JmesPath\search($expGroup, $GLOBALS['wcJsonData']);

    foreach(array_filter($resexpGroup) as $key => $value) {
      $groupNum = $key;
      return $groupArr[$groupNum];
    }
  }

  function getMatchTime($id, $stadID) {
    $expMatchTime = "groups.*.matches[?name == `$id`].date | []";
    $resMatchTime = JmesPath\search($expMatchTime, $GLOBALS['wcJsonData']);

    $timestamp = new DateTime($resMatchTime[0]);
    /* plus how many hours? */
    $timeDiffStad = $GLOBALS['timeDiff'];
    /* add the hours */
    $timestamp->sub(new DateInterval("PT{$timeDiffStad[$stadID]}H"));
    return $timestamp->format('H:i');

  }

  function goals($ht, $at, $md) {
    $exp = "fixtures[?homeTeamName == `$ht` && awayTeamName == `$at` && matchday == `$md`].result | []";
    //execute query
    $res = JmesPath\search($exp, $GLOBALS['fixtures']);
    return $res;
  }

  /** returns the status of the game
    * @param    string    $ht       name of the hometeam
    * @param    string    $at       name of the awayteam
    * @param    int       $md       int of the matchday for security purposes
    * @return   array     ----      returns the first entry of the returning array
    */
  function statGame($ht, $at, $md) {
    $exp = "fixtures[?homeTeamName == `$ht` && awayTeamName == `$at` && matchday == `$md` ].status | []";
    $res = JmesPath\search($exp, $GLOBALS['fixtures']);

    return $res[0];
  }

  function matchOpponent($id, $team) {
    switch ($team) {
      case "home":
        $exp = "groups.*.matches[?name == `$id`].home_team | []";
        break;
      case "away":
        $exp = "groups.*.matches[?name == `$id`].away_team | []";
        break;
      default : "error";
    }
    $res = JmesPath\search($exp, $GLOBALS['wcJsonData']);
    return $res[0];
  }

  function squadName($id) {
    $exp = "teams[?id == `$id`].name | []";
    $res = JmesPath\search($exp, $GLOBALS['wcJsonData']);
    return $res[0];
  }

  function squadFlag($id) {
    $exp = "teams[?id == `$id`].iso2 | []";
    $res = JmesPath\search($exp, $GLOBALS['wcJsonData']);
    /* iso2 data will be picked up from flag array */
    return $GLOBALS['countryFlags'][$res[0]];
  }
  ?>
