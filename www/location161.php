<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(161, $db);
    add_location_clue(161,$db);

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
print_critter_trail_start(24,$db);
?>
<div class=location>
<img src=assets/location161.png>
<h2>A Swampy Forest</h2>

<p>You are standing on the edge of a swamp.  Someone has written Forest of Dean in the mud.</p>

<?php
print_footer(161, $db);
?>
</div>
</body>
</html>
