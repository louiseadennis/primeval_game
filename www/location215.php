<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(215, $db);
    add_location_clue(215, $db);

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
print_standard_start($db);
?>
<div class=location>
<img src=assets/location215.png>
<h2>A Deserted City</h2>

<p>You are on the streets of a deserted city.  It is filled with the remains of rusting cars.  One a crumbling wall is written "Vowels: one, three, one"</p>

<?php
print_footer(215, $db);
?>
</div>
</body>
</html>
