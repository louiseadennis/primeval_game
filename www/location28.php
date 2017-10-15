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

check_location(28, $mysql);

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
$rex_collected = check_for_character('rex', $mysql);

?>
<div class=main>
<?php
print_standard_start($mysql);
?>
<div class=location>
<img src=assets/location28.png>
<h2>A Dusty Plain</h2>

<p>You are standing in a dusty plain surrounded by conifers, with a volcano in the distance.  Coelurosauravus' circle overhead.</p>

<?php

if (!$rex_collected) {
     update_users("new_character", "rex", $mysql);
     print "<img src=assets/rex.png align=left>";
     print "<p>Rex is here.  He flies down into your arms.</p>";
}
?>
</div>
</body>
</html>