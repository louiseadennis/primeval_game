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

check_location(9, $mysql);

?>
<html>
<head>
<title>52 Weeks of Primeval</title>

<link rel="stylesheet" href="./styles/default.css" type="text/css">
</head>
<body>
<?php
print_header($mysql);

$phase = get_user_phase($mysql);
$ryan_collected = check_for_character('ryan', $mysql);
$visited_already = get_value_from_users("new_character", $mysql);
if (!$ryan_collected) {
   if ($visited_already != 'ryan') {
      create_new_fight_event(1, $mysql);
      $event_id = get_unresolved_event_id($mysql);
      update_event($event_id, "critter_hp", 3, $mysql);
      update_users("random_anomalies", 1, $mysql);
      add_location_clue(9, $mysql);
      add_equipment("assault rifle", $mysql);
   }
}

?>
<div class=main>
<?php
print_standard_start($mysql);
?>
<div class=location>
<img src=assets/location9.png>
<h2>Coastal Area</h2>

<p>You are standing by the banks of a river.  There are flowering shrubs and seed fern trees.  You can see a volcano in the distance.</p>

<?php

if (!$ryan_collected) {
     update_users("new_character", "ryan", $mysql);
     print "<img src=assets/ryan.png align=left>";
     print "<p>Ryan is here.  He has a spare assault rifle.</p>";
     $critter_hp = get_value_for_location_id(9, "critter_hp", $mysql);
     if ($critter_hp > 0) {
          print "<p>He is being attacked by a Future Predator which he has wounded.</p>";
     }
     print "<p>Ryan has a note which reads.  \"Famous Hamlet Quote\"</p>";


}

?>
</div>
</body>
</html>