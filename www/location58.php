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

check_location(58, $mysql);

?>
<html>
<head>
<title>52 Weeks of Primeval</title>

<link rel="stylesheet" href="./styles/default.css?v=1" type="text/css">
</head>
<body>
<?php
print_header($mysql);

$phase = get_user_phase($mysql);
$kermit_collected = check_for_character('kermit', $mysql);
if (!$kermit_collected) {
     $visited_once = get_value_from_users("new_character", $mysql);
     if ($visited_once != 'kermit') {
	add_equipment('hand gun', $mysql);
     }
}

?>
<div class=main>
<?php
print_standard_start($mysql);
?>
<div class=location>
<img src=assets/location58.png>
<h2>An Underground Bunker</h2>

<p>You are in an underground bunker that seems to be deserted.  Outside toxic winds blow.</p>

<?php

if (!$kermit_collected) {
     update_users("new_character", 'kermit', $mysql);
     print "<img src=assets/kermit.png align=left>";
     print "<p>Kermit is here.  He shares his hand gun amunition with you.</p>";
     print "<p>Helen has given him the clue \"Switch to A.\"</p>";
     add_location_clue(58, $mysql);
}
?>
</div>
</body>
</html>