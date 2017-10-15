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

check_location(21, $mysql);

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
$blade_collected = check_for_character('blade', $mysql);
if (!$blade_collected) {
   add_equipment("knife", $mysql);
}
?>
<div class=main>
<?php
print_standard_start($mysql);
?>
<div class=location>
<img src=assets/location21.png>
<h2>A River in a Forest</h2>

<p>You are standing on a river bank in a forest of conifers and seed ferns.  Coelphysis dart along the banks opposite more placid Placerias.</p>

<?php

if (!$blade_collected) {
     update_users("new_character", 'blade', $mysql);
     print "<img src=assets/blade.png align=left>";
     print "<p>Blade is here.  Obviously he has knives and generously lets you have one.</p>";
     print "On the ground is written: <p><table><tr><td>4</td><td>N</td><td>0</td></tr><tr><td>3</td><td>M</td><td>4</td></tr><tr><td>L</td><td>C</td><td>Y</td></tr></table></p>";
     add_location_clue(21, $mysql);
}
?>
</body>
</html>