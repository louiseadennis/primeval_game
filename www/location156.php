<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(156, $db);
    add_location_clue(156,$db);

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
print_critter_trail_start(25, $db);
?>
<div class=location>
<img src=assets/location156.png>
<h2>A Shopping Centre</h2>

<p>You are standing in an empty shopping centre.  Graffittied on the shutters is: head ButTeD</p>

<?php
    print_travel(156,$db);
print_footer(156, $db);
?>
</div>
</body>
</html>
