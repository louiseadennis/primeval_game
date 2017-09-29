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

check_location(17, $mysql);

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
$connor_collected = check_for_character('connor', $mysql);

print_device($mysql);
?>
<div class=main>
<?php
print_standard_start($mysql);
?>
<h2>A Cliff Top</h2>

<p>You are standing on a cliff above a see.  There is a distinct chill in the air.  A few flowers are blossoming, amid crass like plants.</p>

<?php

if (!$connor_collected) {
     update_users("new_character", 'connor', $mysql);
     print "<img src=assets/connor.png align=left>";
     print "<p>Connor is here.  He tells you excitedly that he thinks it is the Cretaceous somewhere in Australia or Antarctica.  He has seen a Labyrinthodont and a Koolasuchus.</p>";
     print "<p>He listens to your tale with interest and examines the device.  He says he thinks the dial must set eras with, at a guess, 8 representing the Holocene.  Given Helen programmed it, he is prepared to bet one the ARC is either A, B or C.</p>";
     add_location_clue(17, $mysql);
}

print_equipment($mysql);
?>
</body>
</html>