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

check_location(1, $mysql);

$phase = get_user_phase($mysql);
$connor_collected = check_for_character('connor', $mysql);
$nick_collected = check_for_character('nick', $mysql);
$stephen_collected = check_for_character('stephen', $mysql);
$lester_collected = check_for_character('lester', $mysql);
$ryan_collected = check_for_character('ryan', $mysql);

if ($connor_collected && $nick_collected && $stephen_collected && $lester_collected && $ryan_collected && $phase ==1 && maximum_phase() > 1) {
   update_users("phase", 2, $mysql);
}


$leek_collected = check_for_character('leek', $mysql);
if (!$leek_collected && $phase == 2) {
   $new_character = get_value_from_users("new_character", $mysql);
   if ($new_character != 'leek') {
      update_users("has_device", 0, $mysql);
      }
} else if ($leek_collected && $phase == 2 && maximum_phase() > 2) {
  update_users("phase", 3, $mysql);
  $phase = 3;
}

$becker_collected = check_for_character('becker', $mysql);
$danny_collected = check_for_character('danny', $mysql);
if ($becker_collected && $danny_collected && $phase==3 && maximum_phase() > 3) {
   update_users("phase", 4, $mysql);
   $phase = 4;
}

$matt_collected = check_for_character('matt', $mysql);
$ethan_collected = check_for_character('ethan', $mysql);
$burton_collected = check_for_character('burton', $mysql);
if ($matt_collected && $ethan_collected && $burton_collected && maximum_phase() > 4) {
   update_users("phase", 5, $mysql);
   $phase = 5;
}

$evan_collected = check_for_character('evan', $mysql);

?>
<html>
<head>
<title>52 Weeks of Primeval - The ARC</title>

<link rel="stylesheet" href="./styles/default.css" type="text/css">
</head>
<body>
<?php
print_header($mysql);
print_device($mysql);
?>
<div class=main>
<?php
print_standard_start($mysql);
?>
<h2>The ARC</h2>
<?php



if ($phase == 1) {
?>
    <p>You are in the ARC.  Pinned to the nearest console is a note:</p>

    <p><i>I have kidnapped all the men I could find in this building and scattered them through time.  I challenge you to recover them!</i></p>
    <p><i>Helen</i></p>

<?php
    if (get_value_from_users("travel_type", $mysql) == "start") {
       anomaly(2);
    }

} else {

  if ($phase == 2 && !$leek_collected) {
   print "<p>You are in the ARC.  Leek was waiting for you and stole the device!</p>";
  }

  if ($phase == 3) {
     print "<p>Connor has been examining the device.  He finds that an extra panel has been attached to the back.  When he prizes this off a switch is revealed!</p>"; 
  }

  if ($phase == 4) {
     if (!$matt_collected) {
        update_users("new_character", 'matt', $mysql);
     	print "<img src=assets/matt.png align=left>";
	add_equipment('emd', $mysql);

        print "<p>Matt suddenly appears at the ARC.  He says he thinks all the time travelling you have been doing has altered some parts of history and that Ethan and Burton may now be at different locations.  To prove his point he finds Helen's note again and it now reads <i>Go to the Forest of Dean</i>.</p>";
	add_location_clue(1, $mysql);
     }
  }

  if ($phase == 5) {
     if (!$evan_collected) {
     	print "<p>Lester tells you that a message has come from Canada.  Helen has now kidnapped all the men associated with Cross Photonics and Project Magnet.  He suggests you take a plane to Cross Photonics immediately.</p>";
     }
  }

  if ($phase > 1) {
     print "<p>From here you can get by conventional transport to:<ul>";
     $accessible = get_present_day_locations($mysql);
     foreach ($accessible as $by_car) {
          if ($by_car != 1) {
     	      print "<li>";
	      print_accessible_location($by_car, $mysql);
	      print "</li>";
	  }
     }
     print "</ul></p>";
  }
}

$d100_roll = rand(1, 100);
if ($d100_roll < default_lester_recharges()) {
   $equip_list = get_value_from_users("equipment", $mysql);
   $equip_id_array = explode(",", $equip_list);
   $random = rand(0, count($equip_id_array));
   $name = get_value_for_equip_id("name", $equip_id_array[$random], $mysql);
   add_equipment($name, $mysql);
   $default_uses = get_value_for_equip_id("default_uses", $equip_id_array[$random], $mysql);
   if ($default_uses < 500) {
      print "<p>Lester agrees to resupply your $name.  He refuses to buy a tank.</p>";
   }
}

print_equipment($mysql);

?>
</body>
</html>