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

check_location(35, $mysql);

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
$burton_collected = check_for_character('burton', $mysql);
if ($phase > 3 && !$burton_collected) {
   $visited = get_value_from_users("new_character", $mysql);
   if ($visited != 'burton') {
        add_equipment("first aid kit", $mysql);
   }
}
?>
<div class=location>
<img src=assets/location35.png>
<h2>A grassy plain</h2>

<p>You are standing in a grassy plain.  Small horses are grazing around you.</p>

<?php

if ($phase > 3 && !$burton_collected) {
     update_users("new_character", 'burton', $mysql);
     print "<img src=assets/burton.png align=left>";
     print "<p>Burton is here.  He has a first aid kit.  He isn't interested in finding more people but wants to get back to the ARC.</p>";
     add_location_clue(35, $mysql);
}
?>
</div>
</body>
</html>