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

check_location(5, $mysql);

?>
<html>
<head>
<title>52 Weeks of Primeval</title>

<link rel="stylesheet" href="./styles/default.css" type="text/css">
</head>
<body>
<?php
update_users("has_log", 1, $mysql);
print_header($mysql);

$phase = get_user_phase($mysql);
$nick_collected = check_for_character('nick', $mysql);

print_device($mysql);
?>
<div class=main>
<?php
print_standard_start($mysql);
?>
<h2>A Stream in Silurian Wales/England</h2>

<p>You are the edge of a stream.  Strange and small vascular plants cluster at the water's edge, but inland all is bare rock.</p>

<?php

if (!$nick_collected) {
     add_location_clue(5, $mysql);
     update_users("new_character", 'nick', $mysql);
     print "<img src=assets/nick.png align=left>";
     print "<p>Nick is here</p>";
     print "<p>Nick thinks you are in the Silurian, somewhere in what will eventually become England or Wales.  He says Helen left him there saying only that he should remember how many arms the Stuertzaster marstoni has and the first letter of Lyell's first name.</p>";
     print "<p>Nick admires the device and suggests you use his notebook to keep a log of all the locations it takes you to.</p>";
     print "<p><b>You now have a Log Book</b></p>";
}

print_equipment($mysql);
?>
</body>
</html>