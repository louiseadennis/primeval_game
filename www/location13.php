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

check_location(13, $mysql);

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
$lester_collected = check_for_character('lester', $mysql);
if (!$lester_collected) {
   add_equipment("breathing aparatus", $mysql);
   add_location_clue(13, $mysql);
}

print_device($mysql);
?>
<div class=main>
<?php
print_standard_start($mysql);
?>
<h2>A Deserted Highway</h2>

<p>You are standing on a deserted highway.  A rusting car has been abandoned here.  It's window long  since smashed.  A dry wind carries a strange acidic smell on the air.</p>

<?php

if (!$lester_collected) {
     update_users("new_character", 'lester', $mysql);
     print "<img src=assets/lester.png align=left>";
     print "<p>Lester is here.  He brushes the lapels of his suit when he sees you.  <p>\"At last, Helen said someone would be along eventually. She said to check e<sup>i&pi;</sup> + 1 site B.  She also said you would need this.\"</p>  He hands you a some breathing aparatus.</p>";
}

print_equipment($mysql);
?>
</body>
</html>