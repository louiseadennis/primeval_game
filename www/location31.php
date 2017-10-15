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

check_location(31, $mysql);

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
$ethan_collected = check_for_character('ethan', $mysql);

?>
<div class=main>
<?php
print_standard_start($mysql);
?>
<div class=location>
<img src=assets/location31.png>
<h2>Marshy Pools</h2>

<p>You are standing in a landscape of marshy pools.  An Eryops flops about in the water of one of the larger ones.</p>

<?php

if ($phase > 3 && !$ethan_collected) {
     update_users("new_character", 'ethan', $mysql);
     print "<img src=assets/ethan.png align=left>";
     print "<p>Ethan is here.  He says Helen said to look to the Devonian Sea.</p>";
     add_location_clue(31, $mysql);
}
?>
</div>
</body>
</html>