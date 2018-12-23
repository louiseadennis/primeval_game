<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(138, $db);
    add_location_clue(138,$db);

?>
<html>
<head>
<title>12 Months of Primeval Denial</title>

<link rel="stylesheet" href="./styles/default.css" type="text/css">
</head>
<body>
<?php
print_header($db);
?>
<div class=main>
<?php
print_critter_trail_start(12,$db);
?>
<div class=location>
<img src=assets/location138.png>
<h2>A Cretaceous Forest</h2>

<p>You are standing in a forest of fir trees.  Song lyrics for the Cell Block Tango have been pinned to one tree with '5 start' written on it.</p>

<?php
print_footer(138, $db);
?>
</div>
</body>
</html>
