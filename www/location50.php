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

check_location(50, $mysql);

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
<img src=assets/location50.png>
<h2>An Abandoned Camp.</h2>

<p>You are in the middle of a forest of conifers and leafy trees.  Someone seems to have been camping here.  You can see traces of a fire pit and hand-made wooden spears inside the remains of a makeshift hut made from tree roots.   Tin cans are suspended from string around the area.  You think this must be where Connor and Abby lived for a year.</p>

</div>
</body>
</html>