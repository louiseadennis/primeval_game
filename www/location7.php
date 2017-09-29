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

check_location(7, $mysql);

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

print_device($mysql);
?>
<div class=main>
<?php
print_standard_start($mysql);
?>
<h2>A Coniferous Forest</h2>

<p>You are standing in a small clearing in a coniferous forest.  A circle of large rocks surround you: six on one side and three on the other.  Through the trees you can see a Stegosaurus in the undergrowth.</p>


<?php
add_location_clue(7, $mysql);
print_equipment($mysql);
?>
</body>
</html>