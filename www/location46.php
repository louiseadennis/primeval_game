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

check_location(46, $mysql);
$phase = get_value_from_users("phase", $mysql);

$hp = get_value_from_users("hp", $mysql);
$new_hp = $hp - 1;

update_users("hp", $new_hp, $mysql);

?>
<html>
<head>
<title>52 Weeks of Primeval</title>

<link rel="stylesheet" href="./styles/default.css" type="text/css">
</head>
<body>
<?php
print_header($mysql);
?>
<div class=main>
<?php
print_standard_start($mysql);
?>
<div class=location>
<img src=assets/location46.png>
<h2>A Frozen Landscape</h2>

<p>You are standing in a frozen landscape and the air is hard to breathe.  <b>You can not survive here long.</b></p>

<?php

if ($phase > 4) {
   print "<p>Someone has drawn a crude shape in the snow.</p>";
   print "<img src=\"assets/clue46.png\" align=left>";
   add_location_clue(46, $mysql);
}
?>
</div>
</body>
</html>