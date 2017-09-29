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

check_location(16, $mysql);

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
$lyle_collected = check_for_character('lyle', $mysql);
if (!$lyle_collected) {
   add_equipment("assault rifle", $mysql);
   add_location_clue(16, $mysql);
}

print_device($mysql);
?>
<div class=main>
<?php
print_standard_start($mysql);
?>
<h2>A Dusty Plain</h2>

<p>You are standing in a dusty plain.  A few small seed ferns grow here and there and what look like conifers are visible in the distance.</p>

<?php

if (!$lyle_collected) {
     update_users("new_character", "lyle", $mysql);
     print "<img src=assets/lyle.png align=left>";
     print "<p>Lyle is here</p>";
     print "<p>He has an assault rifle and is looking in at a piece of paper which says \"Jurassic Site A\".</p>";
}

print_equipment($mysql);
?>
</body>
</html>