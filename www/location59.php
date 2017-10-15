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

check_location(59, $mysql);

?>
<html>
<head>
<title>52 Weeks of Primeval</title>

<link rel="stylesheet" href="./styles/default.css?v=1" type="text/css">
</head>
<body>
<?php
print_header($mysql);

$palliere_collected = check_for_character('palliere', $mysql);
if (!$palliere_collected) {
     $visited = get_value_from_users("new_character", $mysql);
     if ($visited != 'palliere') {
          add_equipment("knife", $mysql);
     }
   add_location_clue(59, $mysql);
}

?>
<div class=main>
<?php
print_standard_start($mysql);
?>
<div class=location>
<img src=assets/location59.png>
<h2>A Deserted City</h2>

<p>You are on the streets of a deserted city.  It is filled with the remains of rusting cars.</p>

<?php

if (!$palliere_collected) {
     update_users("new_character", "palliere", $mysql);
     print "<img src=assets/palliere.png align=left>";
     print "<p>Palliere is here, holding off marauding creatures with a knife.</p>";
     print "<p>He says Helen kept talking about how everything was simply tip top.</p>";
}
?>
</div>
</body>
</html>