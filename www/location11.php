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

check_location(11, $mysql);
$inflatable = check_for_equipment("inflatable dinghy", $mysql);

if (!$inflatable) {
   add_equipment("inflatable dinghy", $mysql);
}

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
?>
<div class=main>
<?php
print_standard_start($mysql);
?>
<div class=location>
<img src=assets/location11.png>
<h2>A Dark Forest</h2>

<p>You are standing in a dark forest surrounded by tall trees with thick trunks.  These trunks rarely branch but are topped with a crown of branches bearing clusters of leaves which are long and narrow.  Vast insects dart among the trees.</p>

<p>There is a backpack here with the mark "9C" stamped onto it.</p>


<?php

if (!$inflatable) {
   print "<p>There is an inflatable dinghy inside the backpack</p>";
}
add_location_clue(11, $mysql);
?>
<div>
</body>
</html>