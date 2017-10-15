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

check_location(43, $mysql);

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
$preston_collected = check_for_character('preston', $mysql);
if (!$preston_collected) {
     $visited_once = get_value_from_users("new_character", $mysql);
     if ($visited_once != 'preston') {
	add_equipment('hand gun', $mysql);
     }
}
?>
<div class=main>
<?php
print_standard_start($mysql);
?>
<div class=location>
<img src=assets/location43.png>
<h2>High Cliffs</h2>

<p>You are standing on high cliffs.  Below you the cliffs are full of the nests of Anurognathus.</p>

<?php

if (!$preston_collected) {
     update_users("new_character", 'preston', $mysql);
     print "<img src=assets/preston.png align=left>";
     print "<p>Preston is here.  He is armed with a hand gun.  He tells you that Helen, rather mysteriously, told him to switch vowels in \"sexy\".</p>";
     add_location_clue(43, $mysql);
}
?>
</div>
</body>
</html>