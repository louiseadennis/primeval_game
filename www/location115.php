<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(115, $db);
    add_location_clue(115,$db);

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
print_critter_trail_start(61, $db);
?>
<div class=location>
<img src=assets/location115.png>
<h2>Stanley Park, Vancouver</h2>

<p>You are standing in Stanley Park in Vancouver.  One of the information boards strangely says `No A Card'</p>

<?php
    print_travel(115,$db);
print_footer(115, $db);
?>
</div>
</body>
</html>
