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

check_location(38, $mysql);

$phase = get_user_phase($mysql);
?>
<html>
<head>
<title>52 Weeks of Primeval - Cross Photonics</title>

<link rel="stylesheet" href="./styles/default.css" type="text/css">
</head>
<body>
<?php
print_header($mysql);
print_device($mysql);
print_standard_start($mysql);
?>
<div class=main>
<h2>Cross Photonics</h2>
<?php

if ($phase == 5) {
    print "<p>You arrive at Cross Photonics where Ange Finch shows you yet another note from Helen.  \"If you want the men of Cross Photonics and Project Magnet back then solve this revelation:";
    print "<ul><li>Set the dial to the number mentioned in 6:6</li><li>Set the first switch to the first letter of what these omens portend</li><li>Set the last switch to the word contained in 6:2</li></ul>\"";
    add_location_clue(38, $mysql);

    $d100_roll = rand(1, 100);
    if ($d100_roll < default_lester_recharges()) {
       $equip_list = get_value_from_users("equipment", $mysql);
       $equip_id_array = explode(",", $equip_list);
       $random = rand(0, count($equip_id_array));
       $name = get_value_for_equip_id("name", $equip_id_array[$random], $mysql);
       add_equipment($name, $mysql);
       $default_uses = get_value_for_equip_id("default_uses", $equip_id_array[$random], $mysql);
       if ($default_uses < 500) {
       	  print "<p>Ange offers to resupply your $name.</p>";
       }
    }


} else {
    print "<p>You arrive at Cross Photonics in Canada and are shown politely around.</p>";

}

print "<p>From here you can get by conventional transport to:<ul>";
$accessible = get_present_day_locations($mysql);
foreach ($accessible as $by_car) {
    if ($by_car != 38 && ($phase > 1 || $by_car != 19)) {
      print "<li>";
      print_accessible_location($by_car, $mysql);
      print "</li>";
    }
}
print "</ul></p>";

print_equipment($mysql);

?>
</body>
</html>