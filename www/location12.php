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

check_location(12, $mysql);

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
$fiver_collected = check_for_character('fiver', $mysql);
if (!$fiver_collected) {
   add_equipment("sniper rifle", $mysql);
   add_location_clue(12, $mysql);
}

print_device($mysql);
?>
<div class=main>
<?php
print_standard_start($mysql);
?>
<h2>A Mountain Range</h2>

<p>You are high up on a Mountain overlooking a vast forest.  You can see what appear to be giant dragonflies flitting up above the trees.</p>

<?php

if (!$fiver_collected) {
     update_users("new_character", "fiver", $mysql);
     print "<img src=assets/fiver.png align=left>";
     print "<p>Fiver is here</p>";
     print "<p>He has a sniper rifle and is looking in at a piece of paper which says \"my first is in love and not in live, my second is in clove and not in sieve\".</p>";
}

print_equipment($mysql);
?>
</body>
</html>