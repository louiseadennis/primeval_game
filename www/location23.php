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

check_location(23, $mysql);
$wilder_collected = check_for_character('wilder', $mysql);
if (!$wilder_collected & $phase > 2) {
     $visited=get_value_from_users("new_character", $mysql);
     if ($visited != 'wilder') {
         add_equipment("hand gun", $mysql);
     }
}

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
<img src=assets/location23.png>
<h2>A Rocky Shore</h2>

<p>You are on a bare rocky sea shore.  You can see strange tubular, frond-shaped organisms in the rock pools.</p>

<?php

if (!$wilder_collected & $phase > 3) {
     update_users("new_character", "wilder", $mysql);
     print "<img src=assets/wilder.png align=left>";
     print "<p>Wilder is here.  He tells you that Captain Ross is in the Silurian.</p>";
}
?>
</div>
</body>
</html>