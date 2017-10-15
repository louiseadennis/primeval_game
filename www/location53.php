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

check_location(53, $mysql);

?>
<html>
<head>
<title>52 Weeks of Primeval</title>

<link rel="stylesheet" href="./styles/default.css?v=12" type="text/css">
</head>
<body>
<?php
print_header($mysql);

$pups_collected = check_for_character('alex and Marcus', $mysql);

?>
<div class=main>
<?php
print_standard_start($mysql);
?>
<div class=location>
<img src=assets/location53.png>
<h2>Savannah</h2>

<p>You are standing in a grassy savannah among a tribe of neanderthals and their dogs.</p>

<?php

if (!$pups_collected) {
     update_users("new_character", "alex and Marcus", $mysql);
     print "<img src=assets/alex_and_Marcus.png align=left>";
     print "<p>Alex and Marcus are here.  They come running eagerly towards you.</p>";
}
?>
</div>
</body>
</html>