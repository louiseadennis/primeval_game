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

check_location(2, $mysql);

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
$stephen_collected = 1;
$stephen_collected = check_for_character('stephen', $mysql);
if (!$stephen_collected) {
   add_equipment("tranquiliser rifle", $mysql);
   add_location_clue(2, $mysql);
}


print_device($mysql);
?>
<div class=main>
<?php
print_standard_start($mysql);
?>
<h2>The Forest of Seed Ferns</h2>

<p>You are in a forest made up of seed ferns of various sizes.  Small dinsaur like creatures, which Stephen identifies as Sacisaurus, can be seen running through the trees.</p>
<?php

if (!$stephen_collected) {
      update_users("new_character", "stephen", $mysql);
      print "<img src=assets/stephen.png align=left>";
      print "<p>Stephen is here.</p>";

      print "<p>He is holding a strange device which, he claims, Helen left with him.  It has a dial, a three way switch and an activate button.  Stephen says Helen told him to  select 4 on the dial and A on the switch.  He had been about to try it when you arrived.</p>";
      print "<p>He has a tranquiliser rifle with five darts.</p>";
}

print_equipment($mysql);
?>
</body>
</html>