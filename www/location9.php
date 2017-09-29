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
if (!$ryan_collected) {
   create_new_fight_event($critter_id, $mysql);
   $event_id = get_unresolved_event_id($mysql);
   update_event("critter_hp", 3, $mysql);
   add_equipment("assault rifle", $mysql);
   update_users("random_anomalies", 1, $mysql);
   add_location_clue(9, $mysql);
}

print_device($mysql);
?>
<div class=main>
<?php
print_standard_start($mysql);
?>
<h2>Coastal Area</h2>

<p>You are standing by the shore of a wide, salty sea.  A dank forest grows along the shore containing ferms, broad-leaved trees and conifers.</p>

<?php

if (!$ryan_collected) {
     update_users("new_character", "ryan", $mysql);
     print "<img src=assets/ryan.png align=left>";
     print "<p>Ryan is here</p>";
     $critter_hp = get_value_for_location_id(9, "critter_hp", $mysql);
     if ($critter_hp > 0) {
          print "<p>He is being attacked by a Future Predator which he has wounded.</p>";
     }
     print "<p>Ryan has a note which reads.  \"Famous Hamlet Quote\"</p>";


}

print_equipment($mysql);
?>
</body>
</html>