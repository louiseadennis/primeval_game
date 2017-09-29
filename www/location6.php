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

check_location(6, $mysql);

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
$ross_collected = check_for_character('ross', $mysql);
if (!$ross_collected) {
   add_equipment("hand gun", $mysql);
   add_location_clue(6, $mysql);
}

print_device($mysql);
?>
<div class=main>
<?php
print_standard_start($mysql);
?>
<h2>A Tidal Flat</h2>

<p>You are on the banks of beach or tidal flat.  Nothing much appears to be growing on land, but there are mat like structures floating in pools left behind by the receding tide.</p>

<?php

if (!$ross_collected) {
     update_users("new_character", "ross", $mysql);
     print "<img src=assets/ross.png align=left>";
     print "<p>Ross is here</p>";
     print "<p>He has a hand gun.  He has a note which reads simply \"Sounds like Monet\"</p>";
}

print_equipment($mysql);
?>
</body>
</html>