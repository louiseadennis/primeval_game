<?php
require_once('./config/accesscontrol.php');
require_once('./utilities.php');

// Set up/check session and get database password etc.
require_once('./config/MySQL.php');
session_start();
sessionAuthenticate();

$db = connect_to_db ( $mysql_host, $mysql_user, $mysql_password, $mysql_database);
check_location(214, $db);
    add_location_clue(214,$db);

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
print_critter_trail_start(10,$db);
?>
<div class=location>
<img src=assets/location214.png>
<h2>Desert under a Red Sun</h2>

<p>You are standing in a sandy red desert.  Someone has written DnD+1 in the sand.</p>

<?php
print_footer(214, $db);
?>
</div>
</body>
</html>
