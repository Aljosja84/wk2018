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
<body>
  <div class="headerbar">
    <img src="assets/img/fifa-worldcup-logo-flavor.png" height="95px" style="padding-right: 25px"/>
    <img src="assets/img/fifa-worldcup-title-logo.png" height="50px" style="padding-bottom: 25px"/>
  </div>
  <script>
  /*
  * Here is an example of how to use Backstretch as a slideshow.
  * Just pass in an array of images, and optionally a duration and fade value.
  */

  // Duration is the amount of time in between slides,
  // and fade is value that determines how quickly the next image will fade in
  $('body').backstretch([
   "assets/img/stadiums/bgimgs/1.jpg"
  ,"assets/img/stadiums/bgimgs/2.jpg"
  ,"assets/img/stadiums/bgimgs/3.jpg"
  ,"assets/img/stadiums/bgimgs/4.jpg"
  ,"assets/img/stadiums/bgimgs/5.jpg"
  ,"assets/img/stadiums/bgimgs/6.jpg"
  ,"assets/img/stadiums/bgimgs/7.jpg"
  ,"assets/img/stadiums/bgimgs/8.jpg"
  ,"assets/img/stadiums/bgimgs/9.jpg"
  ,"assets/img/stadiums/bgimgs/10.jpg"
  ,"assets/img/stadiums/bgimgs/11.jpg"
  ,"assets/img/stadiums/bgimgs/12.jpg"
], {duration: 5000, fade: 1750});
  </script>
  
  <div id="social">
<a href="#"><img src='img/blogspot.gif' alt="Blogger" width="30px" height="30px" onmouseover="this.src='img/blogspot_over.gif'" onmouseout="this.src='img/blogspot.gif'" /></a>

<a href="#"><img src='img/facebook.gif' alt="Facebook" width="30px" height="30px" onmouseover="this.src='img/facebook_over.gif'" onmouseout="this.src='img/facebook.gif'" /></a>

<a href="#"><img src='img/twitter.gif' alt="Twitter" width="30px" height="30px" onmouseover="this.src='img/twitter_over.gif'" onmouseout="this.src='img/twitter.gif'" /></a>
</div>
<div id="thumbTool" align="center"></div>
<div id="disclaimer"><a href="#"><img src='img/back.gif'/></a></div>
<div id="thumb1" class="thumb" ><img data='papa' src="img/bg/1_min.jpg" /></div>
<div id="thumb2" class="thumb" ><img src="img/bg/2_min.jpg" /></div>
<div id="thumb3" class="thumb" ><img src="img/bg/3_min.jpg" /></div>
<div id="thumb4" class="thumb" ><img src="img/bg/4_min.jpg" /></div>
<div id="thumb5" class="thumb" ><img src="img/bg/5_min.jpg" /></div>
<div id="thumb6" class="thumb" ><img src="img/bg/6_min.jpg" /></div>
<script src="js/menu.js"></script>
</body>
