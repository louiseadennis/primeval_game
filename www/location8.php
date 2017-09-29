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

check_location(8, $mysql);

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
$ditzy_collected = check_for_character('ditzy', $mysql);
if (!$ditzy_collected) {
   add_equipment("first aid kit", $mysql);
   add_location_clue(8, $mysql);
}

print_device($mysql);
?>
<div class=main>
<?php
print_standard_start($mysql);
?>
<h2>A Deserted Plain</h2>

<p>You are standing on a rocky plain.  Nothing  is growing.</p>

<?php

if (!$ditzy_collected) {
     update_users("new_character", "ditzy", $mysql);
     print "<img src=assets/ditzy.png align=left>";
     print "<p>Ditzy is here</p>";
     print "<p>He has a first aid kit and a note which reads \"BERTH E\"</p>";
}

print_equipment($mysql);
?>
</body>
</html>