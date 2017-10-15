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

check_location(44, $mysql);

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
$mac_collected = check_for_character('mac', $mysql);
if ($phase > 4 && !$mac_collected) {
     $visited_already = get_value_from_users("new_character", $mysql);
     if ($visited_already != 'mac') {
     	   add_equipment('assault rifle', $mysql);
     }
}
?>
<div class=main>
<?php
print_standard_start($mysql);
?>
<div class=location>
<img src=assets/location44.png>
<h2>A Forest Clearing</h2>

<p>You are standing in a clearing in a forest of conifers and broad leafed trees.  Pteranodons fly in the sky over head.</p>

<?php

if ($phase > 4 && !$mac_collected) {
     update_users("new_character", 'mac', $mysql);
     print "<img src=assets/mac.png align=left>";
     print "<p>Mac is here.  He shares some ammunition with you.</p>";
     print "<p>Helen gave him a piece of paper with the letters \"PBPO\" on it and told him the clue was the relationship between HAL and IBM.</p>";
     add_location_clue(44, $mysql);
}
?>
</div>
</body>
</html>