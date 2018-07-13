<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php $page_title = "FIFA Worldcup 2018 Russia"; ?>
  <title><?php echo $page_title; ?></title>

  <!-- Latest compiled and minified Bootstrap CSS -->
  <link rel="stylesheet" type="text/css" href="assets/css/base.css?d=<?php echo time(); ?>">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="js/jquery.hoverIntent.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <?php
  include_once 'functions.php';
  include_once 'footballData.php';
  // create new instance of API class
  $api = new FootballData();
  $standings = $api->getLeagueTable();
  $fixtures = $api->getFixtures();
  ?>
</head>
<body>
  <div class="headerbar">
    <img src="assets/img/fifa-worldcup-logo-flavor.png" height="95px" style="padding-right: 25px"/>
    <img src="assets/img/fifa-worldcup-title-logo.png" height="50px" style="padding-bottom: 25px"/>
    <div id="social">
    <a href="#"><img src='assets/img/blogspot.gif' alt="Blogger" width="30px" height="30px" onmouseover="this.src='assets/img/blogspot_over.gif'" onmouseout="this.src='assets/img/blogspot.gif'" /></a>

    <a href="#"><img src='assets/img/facebook.gif' alt="Facebook" width="30px" height="30px" onmouseover="this.src='assets/img/facebook_over.gif'" onmouseout="this.src='assets/img/facebook.gif'" /></a>

    <a href="#"><img src='assets/img/twitter.gif' alt="Twitter" width="30px" height="30px" onmouseover="this.src='assets/img/twitter_over.gif'" onmouseout="this.src='assets/img/twitter.gif'" /></a>
    </div>
    <div id="thumbTool" align="center"></div>
    <div id="disclaimer"><a href="#"><img src='assets/img/back.gif'/></a></div>
    <div id="thumb1" class="thumb" ><img data='papa' src="img/bg/1_min.jpg" /></div>
    <div id="thumb2" class="thumb" ><img src="img/bg/2_min.jpg" /></div>
    <div id="thumb3" class="thumb" ><img src="img/bg/3_min.jpg" /></div>
    <div id="thumb4" class="thumb" ><img src="img/bg/4_min.jpg" /></div>
    <div id="thumb5" class="thumb" ><img src="img/bg/5_min.jpg" /></div>
    <div id="thumb6" class="thumb" ><img src="img/bg/6_min.jpg" /></div>
    <script src="js/menu.js"></script>
  </div>
  <!-- table for matches and stadium img -->
  <table class="matchTable">
    <!-- stadium rows -->

    <!-- group stage bar -->
    <tr>
      <td rowspan="3" width=15%></td>
      <td colspan="16" class="groupStage">
        GROUP STAGE
      </td>
    </tr>
    <!-- end group stage bar -->
    <!-- matchday bar -->
    <tr>
      <td colspan="6" class="matchday1">
        MATCH DAY 1
      </td>
      <td colspan="6" class="matchday1">
        MATCH DAY 2
      </td>
      <td colspan="4" class="groupStage">
        MATCH DAY 3
      </td>
    </tr>
    <!-- end matchday bar -->
    <!-- playing days bar -->
      <!-- MATCHDAY 1 -->
    <tr>
      <?php
      /* set notification to EU standards */
      $md1 = arrMatchDay(1, 'eu');
      /* for each day create a td */
      for($i=0; $i<daysinMatchDay(1);$i++) {
        echo "<td class=\"matchDate\"><b>".dayOfTheWeek(1, $i)."</b><br>".$md1[$i]."</td>";
      }
      ?>
      <!-- END MATCHDAY 1 -->
      <!-- MATCHDAY 2 -->
      <?php
      /* set notification to EU standards */
      $md1 = arrMatchDay(2, 'eu');
      /* for each day create a td */
      for($i=0; $i<daysinMatchDay(2);$i++) {
        echo "<td class=\"matchDate\"><b>".dayOfTheWeek(2, $i)."</b><br>".$md1[$i]."</td>";
      }
      ?>
      <!-- END MATCHDAY 2 -->
      <!-- MATCHDAY 3 -->
      <?php
      /* set notification to EU standards */
      $md1 = arrMatchDay(3, 'eu');
      /* for each day create a td */
      for($i=0; $i<daysinMatchDay(3);$i++) {
        echo "<td class=\"matchDate\"><b>".dayOfTheWeek(3, $i)."</b><br>".$md1[$i]."</td>";
      }
      ?>
      <!-- END MATCHDAY 3 -->
      <?php
      /* set arrays for matchdays */
      $matchDay1 = arrMatchDay(1);
      $matchDay2 = arrMatchDay(2);
      $matchDay3 = arrMatchDay(3);
      /* rows for each stadium */
      for($i=0;$i<StadRows();$i++) {
        echo "<tr>";
        echo "<td class=\"stadium\">";
        echo "<div>";
        /* img for stadium */
        $stadImg = $i+1;
        $stadID = $i+1;
        echo "<img src='assets/img/stadiums/".$stadImg.".png' class=\"stadiumIMG\"/>";
        echo "<div class=\"cityName\">".strtoupper(stadiumCity($i))."</div>";
        /* capitalize the stadium name */
        echo stadiumName($i)."<br>";
        echo $arrStadCap[$i];
        echo "</div>";
        echo "</td>";

        /* dagen in matchday 1 */
        for($j=0;$j<daysinMatchDay(1);$j++) {
          /* check class for group */
          $matchID = checkStadiumAndDate($i, $matchDay1[$j], 1);
          $class = checkClass($matchID);
          echo "<td style=\"border: 1px solid black;\" class=\"matchCell1\">";
          /* check if there's a match being played in this stadium on this day
             if so, return that match_id
          */
          if(!empty($matchID)) {
            $realmatchID = $matchID-1;
            $homeTeam = squadName(matchOpponent($matchID, 'home'));
            $awayTeam = squadName(matchOpponent($matchID, 'away'));
            /* exception for South Korea */
            if($homeTeam == 'South Korea') { $homeTeam = 'Korea Republic'; }
            if($awayTeam == 'South Korea') { $awayTeam = 'Korea Republic'; }
            /* goals home team FIXED */
            $resultGoals = goals($homeTeam, $awayTeam, 1);
            /* status game FIXED */
            $statFix = statGame($homeTeam, $awayTeam, 1);
            /* if the game has been played, give the match cell an opacity */
            if($statFix == "FINISHED") { ?>
              <script>
              $(document).ready(function(){
                var ogOP = document.getElementById("<?php echo $matchID; ?>").style.opacity;
                  $("#<?php echo $matchID; ?>").hover(function(){
                      $("#cell<?php echo $matchID; ?>").animate({right: "+=30"}, "fast");
                      $(this).fadeTo("fast", 1);
                  }, function() {
                    $("#cell<?php echo $matchID; ?>").animate({right: "-=30"}, "fast");
                    $(this).fadeTo("fast", ogOP);
                });
              });

              </script>
              <?php
            echo "<div id='$matchID' style=\"opacity: 0.25; cursor:pointer\">";
          } else {
            echo "<div id='$matchID'>";
          }
            /* we need match time, home team & away team */
            echo "<div class=\"matchCellTime\">";
            echo getMatchTime($matchID, $stadID);
            /* if game is being played, show a loading icon */
            if($statFix == "IN_PLAY") {
              echo "<div style=\"float:right\"><img src=\"assets/img/inplay.gif\" style=\"padding-left: 5px; padding-top:0px; padding-bottom:0px\"></div>";
              //echo ": IN PLAY";
            }
            echo "</div>";

            echo "<div class=\"$class\" align=\"left\" id='cell".$matchID."' style=\"position: relative\">";
            echo "<div style=\"background-color: #222222; width:25px; top:0; right:-25px;height:100%; position:absolute\">";
            echo "<table style=\"border-collapse: collapse\" width=\"100%\" height=\"100%\"><tr><td class=\"groupStage\">".$resultGoals[0]->goalsHomeTeam."</td></tr><tr><td class=\"groupStage\">".$resultGoals[0]->goalsAwayTeam."</td></tr></table></div>";
            echo "<img src=\"assets/img/flagicos/".squadFlag(matchOpponent($matchID, 'home')).".png\" style=\"padding-right: 5px; padding-top:4px\" height=\"15\" width=\"23\">".strtoupper($homeTeam)."";
            echo "<br>VS<br>";
            echo "<img src=\"assets/img/flagicos/".squadFlag(matchOpponent($matchID, 'away')).".png\" style=\"padding-right: 5px; padding-top:4px\" height=\"15\" width=\"23\">".strtoupper($awayTeam)."";
            echo "</div>";
          }
          //echo $i." : ".$matchDay1[$j];
          echo "</td>";
        }
        /* dagen in matchday 2 */
        for($k=0;$k<daysinMatchDay(2);$k++) {
          /* check class for group */
          $matchID = checkStadiumAndDate($i, $matchDay2[$k], 2);
          $class = checkClass($matchID);
          echo "<td style=\"border: 1px solid black;\" class=\"matchCell2\">";
          /* check if there's a match being played in this stadium on this day
             if so, return that match_id
          */
          if(!empty($matchID)) {
            $realmatchID = $matchID-1;
            $homeTeam = squadName(matchOpponent($matchID, 'home'));
            $awayTeam = squadName(matchOpponent($matchID, 'away'));
            //exception for South Korea
            if($homeTeam == 'South Korea') { $homeTeam = 'Korea Republic'; }
            if($awayTeam == 'South Korea') { $awayTeam = 'Korea Republic'; }
            /* goals home team FIXED */
            $resultGoals = goals($homeTeam, $awayTeam, 2);
            /* status game FIXED */
            $statFix = statGame($homeTeam, $awayTeam, 2);
            /* goals away team */
            $GAT = $fixtures->fixtures[$realmatchID]->result->goalsAwayTeam;
            /* if the game has been played, give the match cell an opacity */
            if($statFix == "FINISHED") { ?>
              <script>
              $(document).ready(function(){
                var ogOP = document.getElementById("<?php echo $matchID; ?>").style.opacity;
                  $("#<?php echo $matchID; ?>").hover(function(){
                      $("#cell<?php echo $matchID; ?>").animate({right: "+=30"}, "fast");
                      $(this).fadeTo("fast", 1);
                  }, function() {
                    $("#cell<?php echo $matchID; ?>").animate({right: "-=30"}, "fast");
                    $(this).fadeTo("fast", ogOP);
                });
              });

              </script>
            <?php
            echo "<div id='$matchID' style=\"opacity: 0.25; cursor:pointer\">";
          } else {
            echo "<div id='$matchID'>";
          }
            /* we need match time, home team & away team */
            echo "<div class=\"matchCellTime\">";
            echo getMatchTime($matchID, $stadID);
            /* if game is being played, show a loading icon */
            if($statFix == "IN_PLAY") {
              echo "<div style=\"float:right\"><img src=\"assets/img/inplay.gif\" style=\"padding-left: 5px; padding-top:0px; padding-bottom:0px\"></div>";
              //echo ": IN PLAY";
            }
            echo "</div>";

            echo "<div class=\"$class\" align=\"left\" id='cell".$matchID."' style=\"position: relative\">";
            echo "<div style=\"background-color: #222222; width:25px; top:0; right:-25px;height:100%; position:absolute\">";
            echo "<table style=\"border-collapse: collapse\" width=\"100%\" height=\"100%\"><tr><td class=\"groupStage\">".$resultGoals[0]->goalsHomeTeam."</td></tr><tr><td class=\"groupStage\">".$resultGoals[0]->goalsAwayTeam."</td></tr></table></div>";
            echo "<img src=\"assets/img/flagicos/".squadFlag(matchOpponent($matchID, 'home')).".png\" style=\"padding-right: 5px; padding-top:4px\" height=\"15\" width=\"23\">".strtoupper($homeTeam)."";
            echo "<br>VS<br>";
            echo "<img src=\"assets/img/flagicos/".squadFlag(matchOpponent($matchID, 'away')).".png\" style=\"padding-right: 5px; padding-top:4px\" height=\"15\" width=\"23\">".strtoupper($awayTeam)."";
            echo "</div>";
          }
          //echo $i." : ".$matchDay1[$j];
          echo "</td>";
        }
        /* dagen in matchday 3 */
        for($l=0;$l<daysinMatchDay(3);$l++) {
          /* check class for group */
          $matchID = checkStadiumAndDate($i, $matchDay3[$l], 3);
          $class = checkClass($matchID);
          echo "<td style=\"border: 1px solid black;\" class=\"matchCell3\">";
          /* check if there's a match being played in this stadium on this day
             if so, return that match_id
          */
          if(!empty($matchID)) {
            $realmatchID = $matchID-1;
            $homeTeam = squadName(matchOpponent($matchID, 'home'));
            $awayTeam = squadName(matchOpponent($matchID, 'away'));
            //exception for South Korea
            if($homeTeam == 'South Korea') { $homeTeam = 'Korea Republic'; }
            if($awayTeam == 'South Korea') { $awayTeam = 'Korea Republic'; }
            /* goals home team FIXED */
            $resultGoals = goals($homeTeam, $awayTeam, 3);
            /* status game FIXED */
            $statFix = statGame($homeTeam, $awayTeam, 3);
            /* goals away team */
            $GAT = $fixtures->fixtures[$realmatchID]->result->goalsAwayTeam;
            /* if the game has been played, give the match cell an opacity */
            if($statFix == "FINISHED") { ?>
              <script>
              $(document).ready(function(){
                var ogOP = document.getElementById("<?php echo $matchID; ?>").style.opacity;
                  $("#<?php echo $matchID; ?>").hover(function(){
                      $("#cell<?php echo $matchID; ?>").animate({right: "+=30"}, "fast");
                      $(this).fadeTo("fast", 1);
                  }, function() {
                    $("#cell<?php echo $matchID; ?>").animate({right: "-=30"}, "fast");
                    $(this).fadeTo("fast", ogOP);
                });
              });

              </script>
            <?php
            echo "<div id='$matchID' style=\"opacity: 0.25; cursor:pointer\">";
          } else {
            echo "<div id='$matchID'>";
          }
            /* we need match time, home team & away team */
            echo "<div class=\"matchCellTime\">";
            echo getMatchTime($matchID, $stadID);
            /* if game is being played, show a loading icon */
            if($statFix == "IN_PLAY") {
              echo "<div style=\"float:right\"><img src=\"assets/img/inplay.gif\" style=\"padding-left: 5px; padding-top:0px; padding-bottom:0px\"></div>";
              //echo ": IN PLAY";
            }
            echo "</div>";

            echo "<div class=\"$class\" align=\"left\" id='cell".$matchID."' style=\"position: relative\">";
            echo "<div style=\"background-color: #222222; width:25px; top:0; right:-25px;height:100%; position:absolute\">";
            echo "<table style=\"border-collapse: collapse\" width=\"100%\" height=\"100%\"><tr><td class=\"groupStage\">".$resultGoals[0]->goalsHomeTeam."</td></tr><tr><td class=\"groupStage\">".$resultGoals[0]->goalsAwayTeam."</td></tr></table></div>";
            echo "<img src=\"assets/img/flagicos/".squadFlag(matchOpponent($matchID, 'home')).".png\" style=\"padding-right: 5px; padding-top:4px\" height=\"15\" width=\"23\">".strtoupper($homeTeam)."";
            echo "<br>VS<br>";
            echo "<img src=\"assets/img/flagicos/".squadFlag(matchOpponent($matchID, 'away')).".png\" style=\"padding-right: 5px; padding-top:4px\" height=\"15\" width=\"23\">".strtoupper($awayTeam)."";
            echo "</div>";
          }
          //echo $i." : ".$matchDay1[$j];
          echo "</div>";
          echo "</td>";
        }
        echo "</tr>";
      }
      ?>
  </table>
  <?php
  /** GROUPS AND STANDINGS */
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
    echo "<td style=\"width:10px\" class=\"groupStage\">#</td>";
    echo "<td style=\"width:100px\" class=\"groupStage\">team</td>";
    echo "<td style=\"width:10px\" class=\"groupStage\">mp</td>";
    echo "<td style=\"width:10px\" class=\"groupStage\">g</td>";
    echo "<td style=\"width:10px\" class=\"groupStage\">ga</td>";
    echo "<td style=\"width:10px\" class=\"groupStage\">points</td>";
    echo "</tr>";
    foreach($value as $group) {
      echo "<tr>";
      echo "<td style=\"width:10px\" class=\"groupStage\">".$group->rank."</td>";
      echo "<td style=\"width:10px; text-align:left; padding-left:10px\" class=\"standings\">".$group->team."</td>";
      echo "<td style=\"width:10px\" class=\"standings\">".$group->playedGames."</td>";
      echo "<td style=\"width:10px\" class=\"standings\">".$group->goals."</td>";
      echo "<td style=\"width:10px\" class=\"standings\">".$group->goalsAgainst."</td>";
      echo "<td style=\"width:10px\" class=\"standings\">".$group->points."</td>";
    }
    echo "</tr>";
    echo "</table>";
  }
  ?>
</body>
</html>
