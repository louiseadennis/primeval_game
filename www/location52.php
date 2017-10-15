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

check_location(52, $mysql);

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
$monty_collected = check_for_character('monty', $mysql);

?>
<div class=main>
<?php
print_standard_start($mysql);
?>
<div class=location>
<img src=assets/location52.png>
<h2>A Snowy Plain</h2>

<p>You are standing in a snowy plain amid a herd of mammoths.  You can see a glacier in the distance.</p>

<?php

if (!$monty_collected) {
     update_users("new_character", "monty", $mysql);
     print "<img src=assets/monty.png align=left>";
     print "<p>Monty is here and seems really pleased to see you.</p>";
}
?>
</div>
</body>
</html>