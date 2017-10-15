<?php 
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$mysql = mysql_connect($mysql_host, $mysql_user, $mysql_password);
if (!mysql_select_db($mysql_database))
  showerror();

check_location(37, $mysql);

?>
<html>
<head>
<title>52 Weeks of Primeval</title>

<link rel="stylesheet" href="./styles/default.css" type="text/css">
</head>
<body>
<?php
print_header($mysql);

?>
<div class=main>
<?php
print "<div class=\"dynamic\">";
print "<div class=\"action\">";
print_character_joined($mysql);
print_item_used(0, $mysql);
critter_attack(0, $mysql);
print_health($mysql);
print_wait($mysql);
$prev_location = get_value_from_users("prev_location", $mysql);

if (!junction_here($mysql)) {
   create_anomaly_junction($mysql);
}

$coin = rand(0,1);
if ($coin == 1) {
   $d10 = rand(1, 10);
   change_anomaly($d10, $prev_location, $mysql);
}
print "</div>";
      $has_device = get_value_from_users("has_device", $mysql);
      $phase = get_value_from_users("phase", $mysql);
      if ($phase > 1 || $has_device) {
            update_prev_coordinates($mysql);
      	    print "<div class=device>";
          print_device($mysql);
        print_equipment($mysql);
         print "</div>";
      }
print "</div>";
?>
<div class=location>
<img src="assets/location37.png">
<h2>An Anomaly Junction</h2>

<p>You are standing in a grassy landscape.  Anomalies stretch as far as the eye can see.  There will probably be a lot of random creatures wandering about here.  A large cross is marked out in stones.  As you stand at the cross:</p>

<?php
print "<ul>";
$d1 = get_anomaly_destination("a1", $mysql);
if ($d1 > 0) {
   print "<li>There is an anomaly close by to the <b>north</b>:";
   print_junction_anomaly("a1", $mysql);
   if ($d1 == $prev_location) {
      print "<p>You just came through this anomaly.</p>";
      update_users("anomaly", 1, $mysql);
   }
   print "</li>";
} 

$d2 = get_anomaly_destination("a2", $mysql);
if ($d2 > 0 & $d2 != $d1) {
   print "<li>There is an anomaly far away to the <b>north</b>:";
   print_junction_anomaly("a2", $mysql);
   if ($d2 == $prev_location) {
      print "<p>You just came through this anomaly.</p>";
      update_users("anomaly", 1, $mysql);
   }
   print "</li>";
} 

$d3 = get_anomaly_destination("a3", $mysql);
if ($d3 > 0 & $d2 != $d2 & $d3 != $d1) {
   print "<li>There is an anomaly close by to the <b>north east</b>:";
   print_junction_anomaly("a3", $mysql);
   if ($d3 == $prev_location) {
      print "<p>You just came through this anomaly.</p>";
      update_users("anomaly", 1, $mysql);
   }
   print "</li>";
} 

$d4 = get_anomaly_destination("a4", $mysql);
if ($d4 > 0 & $d4 != $d3 & $d4 != $d2 & $d4 != $d1) {
   print "<li>There is an anomaly close by to the <b>east</b>:";
   print_junction_anomaly("a4", $mysql);
   if ($d4 == $prev_location) {
      print "<p>You just came through this anomaly.</p>";
      update_users("anomaly", 1, $mysql);
   }
   print "</li>";
} 

$d5 = get_anomaly_destination("a5", $mysql);
if ($d5 > 0 & $d5 != $d4 & $d5 != $d3 & $d5 != $d2 & $d5 != $d1) {
   print "<li>There is an anomaly far away to the <b>south east</b>:";
   print_junction_anomaly("a5", $mysql);
   if ($d5 == $prev_location) {
      print "<p>You just came through this anomaly.</p>";
      update_users("anomaly", 1, $mysql);
   }
   print "</li>";
} 

$d6 = get_anomaly_destination("a6", $mysql);
if ($d6 > 0 & $d6 != $d5 & $d6 != $d4 & $d6 != $d3 & $d6 != $d2 & $d6 != $d1) {
   print "<li>There is an anomaly close by to the <b>south</b>:";
   print_junction_anomaly("a6", $mysql);
   if ($d6 == $prev_location) {
      print "<p>You just came through this anomaly.</p>";
      update_users("anomaly", 1, $mysql);
   }
   print "</li>";
} 

$d7 = get_anomaly_destination("a3", $mysql);
if ($d7 > 0 & $d7 != $d6 & $d7 != $d5 & $d7 != $d4 & $d7 != $d3 & $d7 != $d2 & $d7 != $d1) {
   print "<li>There is an anomaly far away to the <b>south</b>:";
   print_junction_anomaly("a3", $mysql);
   if ($d7 == $prev_location) {
      print "<p>You just came through this anomaly.</p>";
      update_users("anomaly", 1, $mysql);
   }
   print "</li>";
} 

$d8 = get_anomaly_destination("a8", $mysql);
if ($d8 > 0 & $d8 != $d7 & $d8 != $d6 & $d8 != $d5 & $d8 != $d4 & $d8 != $d3 & $d8 != $d2 & $d8 != $d1) {
   print "<li>There is an anomaly close by to the <b>south west</b>:";
   print_junction_anomaly("a8", $mysql);
   if ($d8 == $prev_location) {
      print "<p>You just came through this anomaly.</p>";
      update_users("anomaly", 1, $mysql);
   }
   print "</li>";
} 

$d9 = get_anomaly_destination("a9", $mysql);
if ($d9 > 0 & $d9 != $d8 & $d9 != $d7 & $d9 != $d6 & $d9 != $d5 & $d9 != $d4 & $d9 != $d3 & $d9 != $d2 & $d9 != $d1) {
   print "<li>There is an anomaly far away to the <b>west</b>:";
   print_junction_anomaly("a9", $mysql);
   if ($d9 == $prev_location) {
      print "<p>You just came through this anomaly.</p>";
      update_users("anomaly", 1, $mysql);
   }
   print "</li>";
} 

$d10 = get_anomaly_destination("a10", $mysql);
if ($d10 > 0 & $d10 != $d9 & $d10 != $d8 & $d10 != $d7 & $d10 != $d6 & $d10 != $d5 & $d10 != $d4 & $d10 != $d3 & $d10 != $d2 & $d10 != $d1) {
   print "<li>There is an anomaly close by to the <b>north west</b>:";
   print_junction_anomaly("a10", $mysql);
   if ($d10 == $prev_location) {
      print "<p>You just came through this anomaly.</p>";
      update_users("anomaly", 1, $mysql);
   }
   print "</li>";
}
print "</ul>";

$extra_anomaly = get_value_from_users("anomaly", $mysql);
if (!$extra_anomaly) {
   print_anomaly_no_random($mysql);
}
?>
</div>
</body>
</html>