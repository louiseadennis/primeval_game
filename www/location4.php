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

check_location(4, $mysql);

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
$finn_collected = check_for_character('finn', $mysql);
if (!$finn_collected) {
   add_equipment("sniper rifle", $mysql);
   add_location_clue(4, $mysql);
}

print_device($mysql);
?>
<div class=main>
<?php
print_standard_start($mysql);
?>
<h2>An Estuary</h2>

<p>You are on the banks of a wide estuary that flows into the sea.  Mosses and ferns surround you, none growing very high.  In the water of the river, amonites can  be seen.</p>

<?php

if (!$finn_collected) {
     update_users("new_character", "finn", $mysql);
     print "<img src=assets/finn.png align=left>";
     print "<p>Finn is here</p>";
     print "<p>He has a sniper rifle and is looking in confusion at a piece of paper with the number 2 and the letter A written on it.</p>";
}

print_equipment($mysql);
?>
</body>
</html>