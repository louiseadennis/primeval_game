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

check_location(49, $mysql);

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
$hamza_collected = check_for_character('hamza Sayed', $mysql);
if (!$hamza_collected) {
     $visited_once = get_value_from_users("new_character", $mysql);
     if ($visited_once != 'hamza Sayed') {
	add_equipment('first aid kit', $mysql);
     }
}
?>
<div class=main>
<?php
print_standard_start($mysql);
?>
<div class=location>
<img src=assets/location49.png>
<h2>The Banks of a Stream</h2>

<p>You are standing on the banks of a Stream.  Massive pterosaurs circle overhead.</p>

<?php

if (!$hamza_collected) {
     update_users("new_character", 'hamza Sayed', $mysql);
     print "<img src=assets/hamza_Sayed.png align=left>";
     print "<p>Hamza Sayed is here.  He has a first aid kit with him.  When she left him Helen was singing a song.  He recalls the lyrics: <br> Fear me you lords and lady preachers, <br>I descend upon your earth from the skies, <br>I command your very souls you unbelievers, <br>Bring before me what is mine</p>";
     add_location_clue(49, $mysql);
}
?>
</div>
</body>
</html>