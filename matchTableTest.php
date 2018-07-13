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
  <script src="js/jquery-1.10.1.min.js"></script>
  <script src="js/jquery.hoverIntent.js"></script>
  <script src="js/jquery.backstretch.min.js"></script>
  <script src="js/jquery.animate-colors.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
</head>
<?php include_once 'functions.php'; ?>
<table style="width:100%; border: 1px solid black">
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
  <tr>
    <!-- MATCHDAY 1 -->
    <td>
      THU<br>14.06
    </td>
    <td>
      FRI<br>15.06
    </td>
    <td>
      SAT<br>16.06
    </td>
    <td>
      SUN<br>17.06
    </td>
    <td>
      MON<br>18.06
    </td>
    <td>
      TUE<br>19.06
    </td>
    <!-- END MATCHDAY 1 -->
    <!-- MATCHDAY 2 -->
    <td>
      TUE<br>19.06
    </td>
    <td>
      WED<br>20.06
    </td>
    <td>
      THU<br>21.06
    </td>
    <td>
      FRI<br>22.06
    </td>
    <td>
      SAT<br>23.06
    </td>
    <td>
      SUN<br>24.06
    </td>
    <!-- END MATCHDAY 2 -->
    <!-- MATCHDAY 3 -->
    <td>
      MON<br>25.06
    </td>
    <td>
      TUE<br>26.06
    </td>
    <td>
      WED<br>27.06
    </td>
    <td>
      THU<br>28.06
    </td>
  </tr>
    <!-- END MATCHDAY 3 -->

  <?php
  /* set arrays for matchdays */
  $matchDay1 = arrMatchDay(1);
  $matchDay2 = arrMatchDay(2);
  $matchDay3 = arrMatchDay(3);
  /* rows for each stadium */
  for($i=0;$i<StadRows();$i++) {
    echo "<tr>";
    echo "<td style=\"height:100px; border: 2px solid black; width: 5%\">";
    echo stadiumInfo($i);
    echo "</td>";

    /* dagen in matchday 1 */
    for($j=0;$j<daysinMatchDay(1);$j++) {
      $class = checkClass(checkStadiumAndDate($i, $matchDay1[$j], 1));
      echo "<td style=\"border: 1px solid black;\" class=\"$class\">";
      /* check if there's a match being played in this stadium on this day
         if so, return that match_id
      */
      echo checkStadiumAndDate($i, $matchDay1[$j], 1);
      //echo $i." : ".$matchDay1[$j];
      echo "</td>";
    }
    /* dagen in matchday 2 */
    for($k=0;$k<daysinMatchDay(2);$k++) {
      $class = checkClass(checkStadiumAndDate($i, $matchDay2[$k], 2));
      echo "<td style=\"border: 1px solid black;\" class=\"$class\">";
      /* check if there's a match being played in this stadium on this day
         if so, return that match_id
      */
      echo checkStadiumAndDate($i, $matchDay2[$k], 2);
      //echo $i." : ".$matchDay1[$j];
      echo "</td>";
    }
    /* dagen in matchday 3 */
    for($l=0;$l<daysinMatchDay(3);$l++) {
      $class = checkClass(checkStadiumAndDate($i, $matchDay3[$l], 3));
      echo "<td style=\"border: 1px solid black;\" class=\"$class\">";
      /* check if there's a match being played in this stadium on this day
         if so, return that match_id
      */
      echo checkStadiumAndDate($i, $matchDay3[$l], 3);
      //echo $i." : ".$matchDay1[$j];
      echo "</td>";
    }
    echo "</tr>";
  }


  ?>
