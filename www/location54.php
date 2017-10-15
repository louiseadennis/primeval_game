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

check_location(54, $mysql);

?>
<html>
<head>
<title>52 Weeks of Primeval</title>

<link rel="stylesheet" href="./styles/default.css?v=1" type="text/css">
</head>
<body>
<?php
print_header($mysql);

$phase = get_user_phase($mysql);
$stringer_collected = check_for_character('stringer', $mysql);
if (!$stringer_collected) {
     $visited_once = get_value_from_users("new_character", $mysql);
     if ($visited_once != 'stringer') {
	add_equipment('tranquiliser rifle', $mysql);
     }
}
?>
<div class=main>
<?php
print_standard_start($mysql);
?>
<div class=location>
<img src=assets/location54.png>
<h2>A Prarie</h2>

<p>You are standing in a wide grassy  plain.</p>

<?php

if (!$stringer_collected) {
     update_users("new_character", 'stringer', $mysql);
     print "<img src=assets/stringer.png align=left>";
     print "<p>Stringer is here.  He shares some tranquiliser darts with you.</p>";
     print "<p>Helen has given him a picture.</p>";
     print "<img src=assets/clue54.png>";
     add_location_clue(54, $mysql);
}
?>
</div>
</body>
</html>