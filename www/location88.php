<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(88, $db);

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
print_critter_trail_start(27,$db);
?>
<div class=location>
<img src=assets/location88.png>
<h2>A Swamp</h2>

<p>You are standing in the middle of a swamp.  It is hot and humid and you are surrounded by giant seed ferns.  Someone has written BURT in the mud.</p>

</div>
</body>
</html>
