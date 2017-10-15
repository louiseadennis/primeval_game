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

check_location(25, $mysql);

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
$ross_collected = check_for_character('captain Ross', $mysql);
if (!$ross_collected) {
     $visited = get_value_from_users("new_character", $mysql);
     if ($visited != 'captain Ross') {
        add_equipment("breathing aparatus", $mysql);
     }
}
?>
<div class=main>
<?php
print_standard_start($mysql);
?>
<div class=location>
<img src=assets/location33.png>
<h2>A Rocky Landscape</h2>

<p>You are standing in a rocky landscape.  Strange green plants cover the ground but nothing tall can be seen.  The air seems very thin, making you hyperventilate.</p>

<?php

if (!$ross_collected) {
     update_users("new_character", "captain Ross", $mysql);
     print "<img src=assets/captain_Ross.png align=left>";
     print "<p>Captain Ross is here.  He is wearing breathing apparatus.  He tells you that Wilder is in the Edicaran.</p>";
}
?>
</div>
</body>
</html>