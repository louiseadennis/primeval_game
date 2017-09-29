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

check_location(41, $mysql);

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
$hall_collected = check_for_character('colonel Hall', $mysql);

print_device($mysql);
?>
<div class=main>
<?php
print_standard_start($mysql);
?>
<h2>A Swamp</h2>

<p>You are standing in the middle of a swamp.  It is hot and humid and you are surrounded by giant seed ferns.</p>

<?php

if (!$hall_collected & $phase > 4) {
     update_users("new_character", "colonel Hall", $mysql);
     print "<img src=assets/colonel_Hall.png align=left>";
     print "<p>Colonel Henderson Hall is here.  He is raving about a new world order but you do manage to gather that he thinks Major Douglas may be in the Pleistocene.</p>";
     add_location_clue(41, $mysql);
}

print_equipment($mysql);
?>
</body>
</html>