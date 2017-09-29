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

check_location(19, $mysql);

$phase = get_user_phase($mysql);
$leek_collected = check_for_character('leek', $mysql);
$critter_number = get_value_from_users("leek_critter", $mysql);
if (!$leek_collected && $phase == 2 && $critter_number >= 4) {
   update_users("has_device", 1, $mysql);
}

?>
<html>
<head>
<title>52 Weeks of Primeval - Leek's Warehouse</title>

<link rel="stylesheet" href="./styles/default.css" type="text/css">
</head>
<body>
<?php
print_header($mysql);
print_device($mysql);
?>
<div class=main>
<?php
if ($phase == 2) {
   print_leek_start($mysql);
} else {
   print_standard_start($mysql);
}
?>
<h2>A Warehouse</h2>
<?php

if ($phase == 1) {
?>
    <p>You are in an empty Warehouse</p>

<?php
} else {

  if ($phase == 2) {
   print "<p>You are in Leek's Warehouse.</p>"; 

   $critter_hp = get_value_from_users("leek_critter_hp", $mysql);
   if (!is_null($critter_hp) & $critter_hp <= 0) {
      $critter_number = $critter_number + 1;
      update_users("leek_critter", $critter_number, $mysql);
   }

   if ($critter_number == 1) {
     print "<p>There are a number of creatures loose in here.</p>";
      $critter_id = 4;
      if (is_null($critter_hp)) {
      	 $critter_hp = get_value_for_critter_id("hp", $critter_id, $mysql);
	 update_users("leek_critter_hp", $critter_hp, $mysql);
      }
      print "<p>You see a Smilodon.</p>";
   } else if ($critter_number == 2) {
     print "<p>There are a number of creatures loose in here.</p>";
      $critter_id = 5;
      if ($critter_hp < 0) {
      	 $critter_hp = get_value_for_critter_id("hp", $critter_id, $mysql);
	 update_users("leek_critter_hp", $critter_hp, $mysql);
      }
      print "<p>You see a Scutosaurus.</p>";
   } else if ($critter_number == 3) {
     print "<p>There are a number of creatures loose in here.</p>";
      $critter_id = 1;
      if ($critter_hp < 0) {
      	 $critter_hp = get_value_for_critter_id("hp", $critter_id, $mysql);
	 update_users("leek_critter_hp", $critter_hp, $mysql);
      }
      print "<p>You see a Future Predator.</p>";

   } else {
     if (!$leek_collected) {
          update_users("new_character", "leek", $mysql);
     	  print "<img src=assets/leek.png align=left>";
     	  print "<p>Leek is here</p>";
     	  print "<p>You get the device back from him.  He grudgingly tells you that he believes Becker is at Jurassic site B.</p>";
	  add_location_clue(19, $mysql);
     }
      
   }
  }

  print "<p>From here you can get by conventional transport to:<ul>";
  $accessible = get_present_day_locations($mysql);
  foreach ($accessible as $by_car) {
       if ($by_car != 19) {
  	      print "<li>";
	      print_accessible_location($by_car, $mysql);
	      print "</li>";
       }
  }
  print "</ul></p>";
}

print_equipment($mysql);

?>
</body>
</html>