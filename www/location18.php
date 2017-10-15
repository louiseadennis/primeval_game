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

check_location(18, $mysql);

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
$matt_collected = check_for_character('matt Rees', $mysql);
if (!$matt_collected) {
   $visited = get_value_from_users("new_character", $mysql);
   if ($visited != 'matt Rees') {
        add_equipment("first aid kit", $mysql);
   }
   add_location_clue(18, $mysql);
}
?>
<div class=main>
<?php
print_standard_start($mysql);
?>
<div class=location>
<img src=assets/location18.png>
<h2>A Desert</h2>

<p>You are standing in desert environment with only the odd cycad breaking up the sand.  In the distance you can see what looks like a Gorgonopsid.</p>

<?php

if (!$matt_collected) {
     update_users("new_character", "matt Rees", $mysql);
     print "<img src=assets/matt_Rees.png align=left>";
     print "<p>Matt Rees is here</p>";
     print "<p>He has a first aid kit.  He says when Helen left him here, she said to remember the letters IVC.</p>";
}
?>
</div>
</body>
</html>